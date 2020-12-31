#!/bin/bash

if [[ ! -f ./.env ]]; then
   echo "Not exist any .env file configuration"
   exit
fi
#docker-compose -f services/proxy.yml up -d
#docker-compose --compatibility -f services/adminer.yml up -d
#docker-compose --compatibility -f services/elastic.yml up -d
#docker-compose --compatibility -f services/ilead.yml up -d
#docker-compose --compatibility -f services/icvs.yml up -d
#docker-compose --compatibility -f services/icvs.tool.yml up -d
# docker-compose --compatibility -f services/webhooks.yml up -d
#docker-compose --compatibility -f services/cv_fresher.yml up -d
docker-compose --compatibility -f services/cms.yml up -d
docker-compose --compatibility -f services/nginx-proxy.yml up -d
docker-compose --compatibility -f services/nginx-proxy.yml up -d