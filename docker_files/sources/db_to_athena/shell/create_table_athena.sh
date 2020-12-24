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
DATE_PATH=`date +"%Y/%m/%d/"`
COMMAND_MYSQL="--host=${HOST} --user=${USER} --password=${PASSWORD}";

# Fetch all tables of this database
RETURN_TABLES=`mysql ${COMMAND_MYSQL} ${DATABASE} -s -r -e "show tables;"`
TABLES=($(echo $RETURN_TABLES | tr ',' "\n"))

for TABLE in "${TABLES[@]}"
do :
    COLUMNS=$(mysql ${COMMAND_MYSQL} -s -r -e "SELECT GROUP_CONCAT(COLUMN_NAME) FROM information_schema.columns WHERE table_schema='"$DATABASE"' AND table_name='"$TABLE"' AND COLUMN_NAME NOT IN ('note', 'extra', 'description', 'payload', 'exception', 'access_token', 'auth0_id', 'phone', 'identity_id', 'email')")
    IFS=',' read -ra ARRS <<< "$COLUMNS"
    COLUMNS_STRING=""

    for COLUMN in "${ARRS[@]}"; do
        DATA_TYPE=$(mysql ${COMMAND_MYSQL} -s -r -e "SELECT DATA_TYPE FROM information_schema. COLUMNS WHERE table_schema = '"$DATABASE"' AND table_name = '"$TABLE"' AND COLUMN_NAME = '$COLUMN'")

        if [[ $DATA_TYPE == "text" ]]; then
            COLUMNS_STRING+=$COLUMN" string,"
        elif [[ $DATA_TYPE == "datetime" || $DATA_TYPE == "timestamp"  ]]; then
            COLUMNS_STRING+="$COLUMN bigint,"
        elif [[ $DATA_TYPE == "longtext"  ]]; then
            COLUMNS_STRING+="$COLUMN string,"
        elif [[ $DATA_TYPE == "varchar"  ]]; then
            COLUMNS_STRING+="$COLUMN string,"
        else
            COLUMNS_STRING+="$COLUMN $DATA_TYPE,"
        fi
    done

    COLUMNS_STRING=${COLUMNS_STRING::-1}

    CREATE_TABLE_STRING="CREATE EXTERNAL TABLE IF NOT EXISTS "$DATABASE"."${TABLE}"("${COLUMNS_STRING}") ROW FORMAT SERDE 'org.apache.hadoop.hive.serde2.OpenCSVSerde' WITH SERDEPROPERTIES ('serialization.format' =',', 'field.delim' = ',', 'quoteChar' = '\\\"', 'separatorChar' = ',', 'escapeChar' = '\\\\') LOCATION 's3://ihr-dbbackup/"${S3_PATH_PROJECT}"/csv/"${TABLE}"' TBLPROPERTIES ('has_encrypted_data'='false');"
    # CREATE TABLE ON ATHENA
    aws athena start-query-execution --query-string "$CREATE_TABLE_STRING" --output text --result-configuration OutputLocation=s3://ihr-awscli-logs
done