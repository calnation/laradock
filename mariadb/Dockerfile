FROM mariadb:latest

MAINTAINER Mahmoud Zalt <mahmoud@zalt.me>

ADD my.cnf /etc/mysql/conf.d/my.cnf

# copy the file into the container
COPY fix-permissions.sh /docker-entrypoint-initdb.d/fix-permissions.sh

# make it executable
RUN chmod +x /docker-entrypoint-initdb.d/fix-permissions.sh

CMD ["mysqld"]

EXPOSE 3306
