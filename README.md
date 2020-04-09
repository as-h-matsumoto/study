
# summury

* 中小企業診断士取得のための勉強アプリ

* 予約システムアプリ（予約ロジックのオーナー導線ページを削除しているのでrouteを見て用意する必要あり。）

* lavavel5.8で構築（bladeも利用）




# nginx

<pre>
server {
	ssl on;

	client_max_body_size 61M;
	listen 443 default_server;

	ssl_prefer_server_ciphers  on;
	ssl_ciphers		  'EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH';
	ssl_certificate	  /etc/letsencrypt/live/coordiy.com-0001/fullchain.pem;
	ssl_certificate_key  /etc/letsencrypt/live/coordiy.com-0001/privkey.pem;

	server_name study.coordiy.com;
	access_log /var/log/nginx/https.study.coordiy.com;
	root /var/www/study/public;

	charset UTF-8;
	index index.php index.html index.htm;
	location / {
		try_files $uri $uri/ /index.php?$query_string;
	}

	location ~ \.php$ {
			try_files $uri =404;
			fastcgi_split_path_info ^(.+\.php)(/.+)$;
			fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
			fastcgi_index index.php;
			fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
			include fastcgi_params;
	}

	location ~* ^.+.(jpg|jpeg|gif|css|png|js|ico)$ {
		expires 30d;
	}

	gzip on;
	gzip_vary on;
	gzip_comp_level 6;
	gzip_types text/plain text/css application/json application/x-javascript text/xml application/xml application/xml+rss text/javascript application/javascript text/x-js
	gzip_proxied any;
	gzip_buffers 16 8k;
	gzip_disable "MSIE [1-6]\.(?!.*SV1)";

}
</pre>


# php install

<pre>
yum install -y nginx
yum install -y php php-mbstring php-pear php-fpm php-mcrypt php-mysql php-php-fpm php-php-mysqlnd php-php-mcrypt php-php-mbstring php-php-gd php-gd mariadb-server

yum -y install libxml2 libxml2-devel libjpeg libjpeg-devel libpng libpng-devel freetype freetype-devel zlib zlib-devel glibc glibc-devel glib2 glib2-devel curl curl-devel php-mcrypt libmcrypt libmcrypt-devel openssl-devel gd mcrypt mhash libicu-devel libpng12
yum install -y mariadb mariadb-server
systemctl start mariadb
</pre>


# app install
<pre>
cd /var/www/
composer create-project "laravel/laravel=5.8.*" xxx

cd xxx
composer update

php artisan storage:link
chmod -R 775 storage bootstrap/cache
php artisan key:generate

composer require electrolinux/phpquery
composer require intervention/image
composer require paypal/rest-api-sdk-php

composer require paragonie/random_compat
composer require bacon/bacon-qr-code
composer require simplesoftwareio/simple-qrcode
composer require laravelcollective/html

rm -rf app bootstrap public config resources database routes composer.json package.json

git init

git remote add origin https://github.com/as-h-matsumoto/study.git

git pull origin master

mysql -u root -p
create database clala;
quit;
mysql -u root -p clala < clala.sql
</pre>

# login

<pre>
https://xxx.com/login
email: admin@coordiy.com
pass: aaaabbbb
</pre>

# page

<pre>

> 予約機能説明ページ
https://study.coordiy.com/yoyaku

> 管理者ページ
https://study.coordiy.com/owner

> 学習ページ
https://study.coordiy.com/

> 予約ページ
https://study.coordiy.com/SenMonTen/%E3%83%95%E3%83%AC%E3%83%B3%E3%83%81/contents/6/desc

</pre>
