FROM ubuntu:14.04
MAINTAINER Leehom Chen <clh021@gmail.com>

# update resource
# RUN sed -i 's/archive.ubuntu.com/packages.linuxdeepin.com/g' /etc/apt/sources.list
# RUN sed -i 's/archive.ubuntu.com/mirrors.aliyun.com/g' /etc/apt/sources.list
RUN sed -i 's/archive.ubuntu.com/1006.dongshenghuo.com/g' /etc/apt/sources.list

# Install Develop tools
RUN apt-get update
RUN apt-get -y upgrade
RUN apt-get -yq install curl wget git git-review git-svn vim && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/*

# Install packages
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && \
  apt-get -y install supervisor apache2 libapache2-mod-php5 mysql-server php5-mysql pwgen php-apc php5-mcrypt  php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-ming php5-ps php5-pspell php5-recode php5-sqlite php5-tidy php5-xmlrpc php5-xsl python-mysqldb && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/*

# Remove pre-installed database
RUN rm -rf /var/lib/mysql/*

# Add MySQL utils
ADD create_mysql_admin_user.sh /create_mysql_admin_user.sh
RUN chmod 755 /*.sh

# config to enable .htaccess
ADD apache_default /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
RUN php5enmod mcrypt

#Enviornment variables to configure php
ENV PHP_UPLOAD_MAX_FILESIZE 20M
ENV PHP_POST_MAX_SIZE 10M

# useradd chenlianghong in group www-data
ENV PASS 1
RUN echo "User: chenlianghong Pass: $PASS"
RUN useradd --create-home --shell /bin/bash --user-group --groups adm,sudo,www-data chenlianghong
RUN echo "chenlianghong:$PASS" | chpasswd

RUN sed -i 's/APACHE_RUN_USER=www-data/APACHE_RUN_USER=chenlianghong/g' /etc/apache2/envvars
RUN sed -i 's/APACHE_RUN_GROUP=www-data/APACHE_RUN_GROUP=chenlianghong/g' /etc/apache2/envvars

# useradd user in group www-data
# RUN userdel -r user
RUN echo "User: user Pass: $PASS"
RUN useradd --create-home --shell /bin/bash --user-group --groups adm,sudo,www-data user
RUN echo "user:$PASS" | chpasswd

# RUN sed -i 's/APACHE_RUN_USER=www-data/APACHE_RUN_USER=user/g' /etc/apache2/envvars
# RUN sed -i 's/APACHE_RUN_GROUP=www-data/APACHE_RUN_GROUP=user/g' /etc/apache2/envvars

#open php short_open_tag
RUN sed -i 's/short_open_tag = Off/short_open_tag = On/g' /etc/php5/apache2/php.ini

# Configure /app folder with sample app
RUN mkdir -p /app && rm -fr /var/www/html && ln -s /app /var/www/html
ADD index.php /app/index.php

# Add image configuration and scripts
ADD start-apache2.sh /start-apache2.sh
ADD start-mysqld.sh /start-mysqld.sh
ADD run.sh /run.sh
RUN chmod 755 /*.sh
ADD my.cnf /etc/mysql/conf.d/my.cnf
ADD supervisord-apache2.conf /etc/supervisor/conf.d/supervisord-apache2.conf
ADD supervisord-mysqld.conf /etc/supervisor/conf.d/supervisord-mysqld.conf

# Add some tools
ADD usr.local.bin /usr/local/bin

EXPOSE 80 3306
CMD ["/run.sh"]
