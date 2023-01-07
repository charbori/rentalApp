FROM mysql/mysql-server:8.0

ADD ./docker/mysql /docker-entrypoint-initdb.d
EXPOSE 3306

ENTRYPOINT ["/entrypoint.sh"]

EXPOSE 3306 33060
CMD ["mysqld"]
