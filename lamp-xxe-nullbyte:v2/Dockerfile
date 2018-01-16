FROM vulspy/ubuntu-sshd:16.04
MAINTAINER Ambulong <zeng.ambulong@gmail.com>

COPY httpd-2.4.29.tar.gz /tmp/httpd-2.4.29.tar.gz
COPY libxml2_2.8.0+dfsg1-5ubuntu2.1_amd64.deb /tmp/libxml2_2.8.0+dfsg1-5ubuntu2.1_amd64.deb
COPY libxml2-dev_2.8.0+dfsg1-5ubuntu2.1_amd64.deb /tmp/libxml2-dev_2.8.0+dfsg1-5ubuntu2.1_amd64.deb
COPY php-5.3.0.tar.gz /tmp/php-5.3.0.tar.gz

RUN sed -i 's/archive.ubuntu.com/mirrors.ustc.edu.cn/g' /etc/apt/sources.list && \
    apt-get update && \
    apt-get install -y gcc g++ automake automake1.11 autoconf libtool make libcurl4-gnutls-dev libssl-dev libpng-dev libapr1 libapr1-dev libaprutil1 libaprutil1-dev libpcre3 libpcre3-dev libmysqld-dev libmysqlclient-dev && \
    echo "mysql-server mysql-server/root_password password toor" | debconf-set-selections && \
    echo "mysql-server mysql-server/root_password_again password toor" | debconf-set-selections && \
    apt-get -y install mysql-server && \
    apt-get clean && \
    sed -i -e 's/^exit 0/service mysql start\nexit 0/i' /etc/rc.local && \
    service mysql start && \
    cd /tmp && \
    tar -zxvf httpd-2.4.29.tar.gz && cd httpd-2.4.29 && \
    ./configure --prefix=/usr/local/apache --enable-so--enable-cgi--enable-info--enable-rewrite--enable-speling--enable-usertrack--enable-deflate --enable-ssl--enable-mime-magic && \
    make && make install && \
    sed -i -e 's/^exit 0/\/usr\/local\/apache\/bin\/apachectl start\nexit 0/i' /etc/rc.local && \
    cd /tmp && \
    dpkg -i libxml2_2.8.0+dfsg1-5ubuntu2.1_amd64.deb && \
    dpkg -i libxml2-dev_2.8.0+dfsg1-5ubuntu2.1_amd64.deb && \
    ln -s /usr/lib/x86_64-linux-gnu/libpng.so /usr/lib/ && \
    ln -s /usr/lib/x86_64-linux-gnu/libpng.a /usr/lib/ && \
    ln -s /usr/lib/x86_64-linux-gnu/libmysqlclient.so /usr/lib/ && \
    ln -s /usr/lib/x86_64-linux-gnu/libmysqlclient.so /usr/lib/libmysqlclient_r.so && \
    cd /tmp && \
    tar -zxvf php-5.3.0.tar.gz && \
    cd php-5.3.0 && \
    ./configure --prefix=/usr/local/php --with-apxs2=/usr/local/apache/bin/apxs  --with-zlib --enable-mbstring --with-mysql --with-mysql-sock --with-gd --enable-pdo --with-pdo-mysql --enable-sockets --enable-xml --enable-zip --with-curl && \
    make && make install && \
    cp php.ini-development /usr/local/php/lib/php.ini && \
    cd ~ && \
    rm -rf /tmp/* && \
    echo "<FilesMatch \\.php$>" >> /usr/local/apache/conf/httpd.conf && \
    echo "    SetHandler application/x-httpd-php" >> /usr/local/apache/conf/httpd.conf && \
    echo "</FilesMatch>" >> /usr/local/apache/conf/httpd.conf && \
    sed -i -e 's/AllowOverride None/AllowOverride All/i' \
    -e 's/DirectoryIndex index.html/DirectoryIndex index.html index.htm index.php/i' \
    -e '/^#LoadModule rewrite_module/s/^#//' /usr/local/apache/conf/httpd.conf && \
    rm -rf /usr/local/apache/htdocs/* && \
    mkdir -p /var/www && \
    ln -s /usr/local/apache/htdocs /var/www/html && \
    echo '<?php echo "Hello world";?>' > /var/www/html/index.php && \ 
    /usr/local/apache/bin/apachectl start
    

COPY supervisord.conf /etc/supervisord.conf

EXPOSE 22

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]
