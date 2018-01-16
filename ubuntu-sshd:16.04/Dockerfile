FROM ubuntu:16.04
MAINTAINER Ambulong <zeng.ambulong@gmail.com>

RUN apt-get update && \
    apt-get install -y apt-utils net-tools debconf-utils iputils-ping wget curl vim openssh-server unzip supervisor && \
    apt-get clean && \
    echo 'root:toor' |chpasswd && \
    mkdir -p /var/run/sshd && \
    rm -rf /var/lib/apt/lists/* && \
    sed -ri 's/^PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config && \
    sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config

COPY supervisord.conf /etc/supervisord.conf

EXPOSE 22

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]
