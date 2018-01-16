FROM vulspy/lamp-xxe-nullbyte:v2
MAINTAINER Ambulong <zeng.ambulong@gmail.com>

COPY php.ini /usr/local/php/lib/php.ini
COPY DVWA-1.9.tar.gz /tmp/DVWA-1.9.tar.gz
COPY dvwa.sql /tmp/dvwa.sql

RUN service mysql start && \
    mysql -u root -ptoor -e 'create database dvwa;' && \
    mysql -u root -ptoor dvwa < /tmp/dvwa.sql && \
    tar -zxvf /tmp/DVWA-1.9.tar.gz -C /var/www/html/ && \
    rm -rf /tmp/* && \
    chmod -R 755 /var/www/html/ && \
    chmod -R 777 /var/www/html/hackable/uploads/ && \
    chmod 777 /var/www/html/external/phpids/0.6/lib/IDS/tmp/phpids_log.txt
     

COPY supervisord.conf /etc/supervisord.conf

EXPOSE 22 80

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]
