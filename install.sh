#!/bin/bash
USERNAME='root'
PASSWORD='root'
DBNAME='db_blog'
HOST='localhost'

USER_USERNAME='root'
USER_PASSWORD='root'

MySQL=$(cat <<EOF
DROP DATABASE IF EXISTS $DBNAME;
CREATE DATABASE $DBNAME DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
DELETE FROM mysql.user WHERE user='$USER_USERNAME' and host='$USER_PASSWORD';
GRANT ALL PRIVILEGES ON $DBNAME.* to '$USER_USERNAME'@'$HOST' IDENTIFIED BY '$USER_PASSWORD' WITH GRANT OPTION;
EOF
)
echo $MySQL | mysql --user=$USERNAME --password=$PASSWORD

php artisan migrate:refresh --seed



	echo "ok pour gulp et ses dépendances"