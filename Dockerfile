FROM mysql:8.0

COPY install/dump.sql /docker-entrypoint-initdb.d/

ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=lvs_kabinet_319b
ENV MYSQL_USER=railway
ENV MYSQL_PASSWORD=railway