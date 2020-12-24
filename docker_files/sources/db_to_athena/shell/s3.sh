#!/bin/bash

S3KEY=$S3_AWS_KEY
S3SECRET=$S3_AWS_SECRET # pass these in

path=$1
file=$2
aws_path=$3
content_type=$4
bucket='ihr-dbbackup'
date=$(date +"%a, %d %b %Y %T %z")
date_path=`date +"%Y/%m/%d/"`
acl="x-amz-acl:public-read"
string="PUT\n\n$content_type\n$date\n$acl\n/$bucket$aws_path$file"
signature=$(echo -en "${string}" | openssl sha1 -hmac "${S3SECRET}" -binary | base64)
curl -X PUT -T "$path/$file" \
-H "Host: $bucket.s3.amazonaws.com" \
-H "Date: $date" \
-H "Content-Type: $content_type" \
-H "$acl" \
-H "Authorization: AWS ${S3KEY}:$signature" \
"https://$bucket.s3.amazonaws.com$aws_path$file"
