#!/usr/bin/env bash
if [ "x$BASH_SOURCE" == "x" ]; then echo '$BASH_SOURCE not set'; exit 1; fi

mysql_install_db

cd /usr ; /usr/bin/mysqld_safe &

mysqladmin password $MYSQL_PW

# a gutted version of standard mysql_secure_installation
auto_secure_mysql

MYSQL_HOST=127.0.0.1
MYSQL_PORT=3306

# generate databases and user accounts
mysqladmin -p$MYSQL_PW create wordpress
#echo "CREATE USER wordpress@$MYSQL_HOST;" | \
      #mysql -h$MYSQL_HOST -uroot -p$MYSQL_PW
#echo "SET PASSWORD FOR wordpress@$MYSQL_HOST= PASSWORD(\"$WORDPRESS_PW\");" | \
      #mysql -h$MYSQL_HOST -uroot -p$MYSQL_PW
echo "GRANT ALL PRIVILEGES ON wordpress.* TO 'wordpress'@'$MYSQL_HOST' IDENTIFIED \
      BY '$WORDPRESS_PW';" | mysql -h$MYSQL_HOST -uroot -p$MYSQL_PW

mysqladmin -p$MYSQL_PW create owncloud
#echo "CREATE USER owncloud@$MYSQL_HOST;" | \
      #mysql -h$MYSQL_HOST -uroot -p$MYSQL_PW
#echo "SET PASSWORD FOR owncloud@$MYSQL_HOST= PASSWORD(\"$OWNCLOUD_PW\");" | \
      #mysql -h$MYSQL_HOST -uroot -p$MYSQL_PW
echo "GRANT ALL PRIVILEGES ON owncloud.* TO 'owncloud'@'$MYSQL_HOST' IDENTIFIED \
      BY '$OWNCLOUD_PW';" | mysql -h$MYSQL_HOST -uroot -p$MYSQL_PW

mysqladmin -p$MYSQL_PW create wiki
#echo "CREATE USER wiki@$MYSQL_HOST;" | \
      #mysql -h$MYSQL_HOST -uroot -p$MYSQL_PW
#echo "SET PASSWORD FOR wiki@$MYSQL_HOST= PASSWORD(\"$WIKI_PW\");" | \
      #mysql -h$MYSQL_HOST -uroot -p$MYSQL_PW
echo "GRANT ALL PRIVILEGES ON wiki.* TO 'wiki'@'$MYSQL_HOST' IDENTIFIED \
      BY '$WIKI_PW';" | mysql -h$MYSQL_HOST -uroot -p$MYSQL_PW

mysqladmin -p$MYSQL_PW flush-privileges
