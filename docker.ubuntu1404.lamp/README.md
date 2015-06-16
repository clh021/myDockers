Lianghong LAMP
=================

PHP,MySQL,Apache,Composer,PHPUnit,PHPCS,GitReview,GitSVN,Curl,Wget,Vim

Usage
-----

If you have not installed docker you may need to execute the following command

	sudo curl -s https://get.docker.io/ubuntu/ | sudo sh

To create the image

	docker build -t <yourname>/lamp .


Running your lamp docker image
------------------------------

Start your image binding the external ports 80 and 3306 in all interfaces to your container:

	docker run -d -p 80:80 -p 3306:3306 username/my-lamp-app
	docker run -i -t -p 80:80 -p 3306:3306 username/my-lamp-app /bin/bash

Test your deployment:

	curl http://localhost/

Hello world!

Advanced Usage
--------------------

	#Set mysql admin password
	docker run -d -p 80:80 -p 3306:3306 -e MYSQL_PASS="mypass" username/my-lamp-app
	docker run -d -p 80:80 -p 3306:3306 -v /path/to/your/app:/app username/my-lamp-app #start your app in docker
	docker run -i -t -p 80:80 -p 3306:3306 -v /path/to/your/app:/app -v /path/to/your/.bashrc:/.bashrc username/my-lamp-app /bin/bash
	#get an terminal and then use "^C + z" to input your command


**by clh021@gmail.com**


*Appendix*
--------------------

One-time operation

	cat ./ubuntu.lamp.2014110416.tar | sudo docker import - deepin_webserver
	#Depending on your configuration updates apache_default your local hosts file
	sudo docker run -i -t -p 80:80 -p 3306:3306 -v /media/lee/DATA/www:/app -v /media/lee/DATA/www/docker.ubuntu/apache_default:/etc/apache2/sites-available/000-default.conf deepin_webserver /bin/bash

Common Operations

	sudo docker start -i $(sudo docker ps -a | grep deepin_webserver:latest | awk '{print $1}')
	#sudo docker stop $(sudo docker ps -a | grep deepin_webserver:latest | awk '{print $1}')
	#sudo docker export 2104174b736b > /media/lee/DATA/www/test/lianghong.work.ubuntu.2014110611.tar


<VirtualHost *:80>
        ServerAdmin clh021@gmail.com
        DocumentRoot /app/
        <Directory />
                Options FollowSymLinks
                AllowOverride None
        </Directory>
        <Directory /var/www/html>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride FileInfo
                Order allow,deny
                allow from all
        </Directory>
        ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
        <Directory "/usr/lib/cgi-bin">
                AllowOverride None
                Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
                Order allow,deny
                Allow from all
        </Directory>
        ErrorLog ${APACHE_LOG_DIR}/error.log
        LogLevel warn
        CustomLog ${APACHE_LOG_DIR}/access.log combined
        SetEnvIf x-forwarded-proto https HTTPS=on
</VirtualHost>

sudo docker run -i -t -p 80:80 -p 3306:3306 -e MYSQL_PASS="admin" -v ~/WORK/clh021.docker/run.sh:/run.sh -v ~/WORK:/app leehom/deepin.lamp:201411271232 /bin/bash

sudo docker run -i -t -p 80:80 -p 3306:3306 -e MYSQL_PASS="admin" -v ~/WORK:/app leehom/deepin.lamp:201411271232

sudo docker commit 可以把容器转换为镜像


    #镜像迁移
    docker save busybox-1 > /home/save.tar
    docker load < /home/save.tar
    sudo docker cp 7bb0e258aefe:/etc/debian_version .#拷贝容器中的一个文件到本地

sudo service docker restart

sudo docker stop $(docker ps -aq) && sudo docker rm $(docker ps -aq)

sudo docker run --rm -i -t -p 80:80 -p 3306:3306 -v ~/WORK/home.chenlianghong:/home/chenlianghong -v ~/WORK:/app -v ~/WORK/mysqldb:/var/lib/mysql -e MYSQL_PASS="admin" leehom/lamp /bin/bash

docker exec -it [container-id] bash # other tty

php artisan app:install
php artisan app:update
php artisan migrate
php artisan db:seed