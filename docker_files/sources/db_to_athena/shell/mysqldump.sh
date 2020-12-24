#!/bin/bash

SINGLE_PROCESS=true
CURRENT_PATH="/var/lib/mysqldump"

# MAIN DB INFORMATION
PASSWORD=$MYSQL_PWD
HOST=$MYSQL_HOST
USER=$MYSQL_USER
DATABASE=$DATABASE
S3_PATH_PROJECT=$S3_PATH_PROJECT

# List tables to ingore
EXCLUDED_TABLES=(
    manychat_requests
    failed_jobs
)

IGNORED_TABLES_STRING=''
for TABLE in "${EXCLUDED_TABLES[@]}"
do :
   IGNORED_TABLES_STRING+=" --ignore-table=${DATABASE}.${TABLE}"
done

DATE=`date +%Y%m%d%H%M`
COMMAND_MYSQL="--host=${HOST} --user=${USER} --password=${PASSWORD}";

# Fetch all tables of this database
RETURN_TABLES=`mysql ${COMMAND_MYSQL} ${DATABASE} -s -r -e "show tables;"`
TABLES=($(echo $RETURN_TABLES | tr ',' "\n"))

for TABLE in "${TABLES[@]}"
do :
	COLUMNS=$(mysql ${COMMAND_MYSQL} -s -r -e "SELECT GROUP_CONCAT('\`',COLUMN_NAME, '\`') FROM information_schema.columns WHERE table_schema='"$DATABASE"' AND table_name='"$TABLE"' AND COLUMN_NAME NOT IN ('note', 'extra', 'description', 'payload', 'exception', 'access_token', 'auth0_id', 'phone', 'identity_id', 'email')")
    # Check this table is not belong EXCLUDED_TABLES
    if [[ ! " ${EXCLUDED_TABLES[@]} " =~ " ${TABLE} " ]]; then
        DUMPING_STATUS=`mysql ${COMMAND_MYSQL} ${DATABASE} -s -r -e "select status from dump_tracking  where table_name = '"${TABLE}"';"`
        if [[ $DUMPING_STATUS == "in_progress" ]]; then
            continue
        else
            mysql ${COMMAND_MYSQL} ${DATABASE} -e 'INSERT INTO dump_tracking SET table_name = "'${TABLE}'"'
        fi
        # REMOVE OLD FILE BEFORE EXPORT NEW
        find ${CURRENT_PATH}/ -maxdepth 1 -type f -name ${TABLE} -delete
        FILENAME=${TABLE}".csv"
        DATA_DB_FILE=${CURRENT_PATH}/$TABLE/$FILENAME
        mkdir -p ${CURRENT_PATH}/$TABLE/
        # Convert some special column to new value, aws athena need data type match with them
        IFS=',' read -ra ARRS <<< "$COLUMNS"
        COLUMNS_STRING=""

        for COLUMN in "${ARRS[@]}"; do
            COLUMN=`echo $COLUMN | sed 's/[^a-z_A-Z0-9]//g'`

            DATA_TYPE=$(mysql ${COMMAND_MYSQL} -s -r -e "SELECT DATA_TYPE FROM information_schema. COLUMNS WHERE table_schema = '"$DATABASE"' AND table_name = '"$TABLE"' AND COLUMN_NAME = '$COLUMN'")

            if [[ $DATA_TYPE == "date" || $DATA_TYPE == "datetime" || $DATA_TYPE == "timestamp" ]]; then
                COLUMNS_STRING+='IFNULL(UNIX_TIMESTAMP(`'$COLUMN'`), 168078600) as `'$COLUMN'`,'
            else
                if [[ $COLUMN == "phone" || $COLUMN == "name" || $COLUMN == "address" ]]; then
                    COLUMNS_STRING+='REPLACE(`'$COLUMN'`, "\n", " "),'
                else
                    COLUMNS_STRING+='`'$COLUMN'`,'
                fi
            fi
        done
        COLUMNS_STRING=${COLUMNS_STRING::-1}
        QUERY_STRING="SELECT "${COLUMNS_STRING}" FROM "${TABLE}
        # Dump one by one table
	    mysql -BN --raw ${COMMAND_MYSQL} -e "${QUERY_STRING}" ${DATABASE} | sed "s/'/\'/;s/\t/\",\"/g;s/^/\"/;s/$/\"/;s/\n//g" > ${DATA_DB_FILE}
        /bin/sh /var/lib/s3.sh ${CURRENT_PATH}/$TABLE ${FILENAME} /${S3_PATH_PROJECT}/csv/${TABLE}/ text/csv

	    mysql ${COMMAND_MYSQL} ${DATABASE} -e 'DELETE FROM dump_tracking WHERE table_name = "'${TABLE}'"'
    fi
done
