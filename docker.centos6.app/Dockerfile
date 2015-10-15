FROM centos:centos6
MAINTAINER The CentOS Docker App

# patch the system
RUN yum -y update; yum clean all
RUN yum -y install epel-release; yum clean all

# install php
RUN yum -y install php php-fpm php-cli php-pdo php-mysql php-gd php-imap php-ldap php-odbc php-pear php-xml php-xmlrpc php-mbstring php-mcrypt php-bcmath php-mhash libmcrypt; yum clean all
RUN chkconfig php-fpm on

## install mysql
#RUN yum -y install mysql mysql-server; yum clean all
#RUN echo "NETWORKING=yes" > /etc/sysconfig/network
## start mysqld to create initial tables
#RUN service mysqld start
#
## set timezone to PRC
#RUN mv /etc/localtime /etc/localtime.bak
#RUN ln -s /usr/share/zoneinfo/Asia/Shanghai /etc/localtime
#
## install nginx
#RUN yum -y install nginx; yum clean all
##RUN sed -ri 's/user = apache/user = nginx/g' /etc/php-fpm.d/www.conf
##RUN sed -ri 's/group = apache/group = nginx/g' /etc/php-fpm.d/www.conf
#RUN service nginx start
#RUN chkconfig nginx on
#
## install redis
#RUN yum -y install redis; yum clean all
#
## install
#RUN yum -y install pwgen supervisor bash-completion openssh-server psmisc tar;yum clean all
#
## install vim
## RUN yum -y install vim-enhanced
#
#RUN echo "daemon off;" >> /etc/nginx/nginx.conf
#RUN echo "<html><head><title>Hello world!</title><style>body {text-align: center;}</style></head><body><h2 align="center">PHP #Version: <?php echo phpversion();?></h2><?php if(!mysql_connect('localhost', 'root')) { ?><h2>Can't connect to local MySQL Server!</h2><?php } else { ?><h2>MySQL Server version: <?php echo mysql_get_server_info(); ?></h2><?php } phpinfo();?></body></html>" > /usr/share/nginx/html/index.php
EXPOSE 80
#CMD ["/bin/bash", "/start.sh"]