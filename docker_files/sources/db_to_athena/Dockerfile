FROM dshearer/jobber:1.3.4-alpine3.7

USER root
# Install supervisord (+ bash for docker exec access)
RUN apk --no-cache add supervisor bash

RUN apk update && apk add mysql-client nano vim openssl curl py2-pip && pip install --upgrade pip && pip install awscli

# Cleanup
RUN apk del libc-dev go git wget make && \
    rm -rf /var/cache/apk/* && \
    rm -rf /tmp/* && \
    rm -rf /var/log/*

# Forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/jobber.out.log
RUN ln -sf /dev/stderr /var/log/jobber.err.log
RUN chown -R jobberuser:root /var/log/
RUN chmod -R 777 /var/log/
RUN mkdir -p /var/lib/mysqldump && chmod -R 777 /var/lib/mysqldump

USER jobberuser

ENV COLUMNS=150
ENV LINES=35
