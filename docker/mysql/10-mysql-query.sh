echo "
    drop user '${MYSQL_USER}'@'172.27.0.3';
    flush privileges;

    CREATE USER '${MYSQL_USER}'@'172.27.0.3' IDENTIFIED WITH mysql_native_password BY '${MYSQL_ROOT_PASSWORD}';
    CREATE DATABASE IF NOT EXISTS testing;
    flush privileges;

    CREATE DATABASE IF NOT EXISTS rentalApp;
    GRANT ALL PRIVILEGES ON *.* TO '${MYSQL_USER}'@'%';
    flush privileges;
" > /docker-entrypoint-initdb.d/mysql-server.sql
