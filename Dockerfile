FROM ubuntu:20.04

ENV DOCKER_BUILDKIT_PROGRESS=plain
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && \
    apt-get install -y tzdata


ENV TZ=Africa/Johannesburg
RUN echo "Africa/Johannesburg" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata    

RUN apt-get update && \
    apt-get install -y apache2 php mysql-server php-mysql netcat net-tools nano python curl 

EXPOSE 80

CMD service mysql start && \
    service apache2 start && \
    tail -f /var/log/apache2/access.log 

COPY admin.sql /usr/local/bin/admin.sql
COPY admin.sh /usr/local/bin/admin.sh
RUN chmod +x /usr/local/bin/admin.sh
RUN /usr/local/bin/admin.sh