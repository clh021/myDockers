FROM centos:centos6
MAINTAINER The CentOS Project <cloud-ops@centos.org>

RUN yum -y update; yum clean all
RUN yum -y install epel-release; yum clean all
RUN yum -y install httpd php php-mysql php-gd pwgen supervisor bash-completion openssh-server psmisc tar; yum clean all
ADD ./start.sh /start.sh
ADD ./foreground.sh /etc/apache2/foreground.sh
ADD ./supervisord.conf /etc/supervisord.conf
RUN echo %sudo  ALL=NOPASSWD: ALL >> /etc/sudoers