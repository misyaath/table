FROM mysql:8.1.0

LABEL Description="table Mysql image fork of mysql:8.0.30"
LABEL Vendor="table"
LABEL Version=1.0

# --------- Log Directory
RUN mkdir -p /var/log/mysql \
    && touch /var/log/mysql/mysql.log \
    && touch /var/log/mysql/mysql-slow.log \
    && touch /var/log/mysql/mysql.err.log \
    && chown -R mysql:mysql /var/log/mysql \
    && find /var/log/mysql -type f -exec chmod 755 {} \;

# --------- Main command
CMD ["mysqld"]
