FROM vulspy/lamp-xxe-nullbyte:v2
MAINTAINER Ambulong <zeng.ambulong@gmail.com>

COPY xxe.tar.gz /tmp/xxe.tar.gz

RUN tar -zxvf /tmp/xxe.tar.gz -C /var/www/html/ && \
    rm -rf /tmp/* && \
    chmod -R 755 /var/www/html/
     

COPY supervisord.conf /etc/supervisord.conf

EXPOSE 22 80

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]
