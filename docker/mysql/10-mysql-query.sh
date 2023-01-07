echo "
    drop user '${MYSQL_USER}'@'%';
    flush privileges;

    CREATE USER '${MYSQL_USER}'@'%' IDENTIFIED WITH mysql_native_password BY '${MYSQL_ROOT_PASSWORD}';
    CREATE DATABASE IF NOT EXISTS testing;
    GRANT ALL PRIVILEGES ON testing.* TO '${MYSQL_USER}'@'%';
    flush privileges;

    CREATE DATABASE IF NOT EXISTS rentalApp;
    GRANT ALL PRIVILEGES ON rentalApp.* TO '${MYSQL_USER}'@'%';
    flush privileges;
" > /docker-entrypoint-initdb.d/mysql-server.sql
