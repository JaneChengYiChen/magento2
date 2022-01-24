# Magento2

* Ubuntu 20.04.3 
* Nginx
* PHP 7.4
* Mysql
* Elasticsearch

### Nginx
```
$ sudo apt install nginx
```

### PHP
```
$ sudo apt install -y php7.4-common php7.4-opcache php7.4-gd php7.4-mysql php7.4-intl php7.4-xml php7.4-mbstring php7.4-json php7.4-soap php7.4-curl php7.4-xsl php7.4-zip php7.4-fpm php7.4-bcmath
```

### modify php.ini
```
* path
$ vim /etc/php/7.4/fpm/php.ini
$ vim /etc/php/7.4/cli/php.ini

* modify
memory_limit = 2G
max_execution_time = 1800
zlib.output_compression = On

* restart fpm
$ systemctl restart php7.4-fpm
```

### Mysql
```
$ sudo apt install mysql-server
$ sudo mysql_secure_installation
$ mysql -u root -p

* other questions
https://ubuntu.com/server/docs/databases-mysql
```
[1] encounter ERROR 1698 (28000): Access denied for user 'root'@'localhost'
```
* reason： the root MySQL user is set to authenticate using the auth_socket plugin by default rather than with a password. 

$ sudo mysql 
$ SELECT user,authentication_string,plugin,host FROM mysql.user;
$ ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
$ FLUSH PRIVILEGES;
```

### Create Magento DB
```
$ mysql -u root -p
$ create database magentodb;

* Create magentodb user and passworld
$ CREATE USER 'magento'@'localhost' IDENTIFIED BY 'magento_password';

* Give magento'db user all privileges
$ GRANT ALL ON magentodb.* TO 'magento'@'localhost' WITH GRANT OPTION;

$ flush privileges;
```

### Install Git
```
sudo apt install curl git
```

### Install ElasticSearch
```
$ apt-get -y update
$ apt-get install -y openjdk-8-jdk
$ wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-7.16.3-amd64.deb
$ wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-7.16.3-amd64.deb.sha512
$ shasum -a 512 -c elasticsearch-7.16.3-amd64.deb.sha512 
$ sudo dpkg -i elasticsearch-7.16.3-amd64.deb

*** NOT starting on installation, please execute the following statements to configure elasticsearch service to start automatically using systemd
 $ sudo systemctl daemon-reload
 $ sudo systemctl enable elasticsearch.service
### You can start elasticsearch service by executing
 $ sudo systemctl start elasticsearch.service

*** set doc memory
 $sudo vim /etc/elasticsearch/jvm.options
add 
-Xms512m
-Xmx512m

[Other Docs]
https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-elasticsearch-on-ubuntu-20-04

[nginx]
https://gist.github.com/sahilsk/b16cb51387847e6c3329
```


### Magento Install
```
./magento setup:install --base-url=https://domainname/ --db-host=127.0.0.1 --db-name=magentodb --db-user=magento --db-password=magento_password --admin-firstname=admin --admin-lastname=admin --admin-email=freedomerest@gmail.com --admin-user=admin --admin-password=admin123 --language=en_US --currency=USD --timezone=Asia/Taipei --use-rewrites=1
```

#### Nginx sites-available/magento2
```
upstream fastcgi_backend {
     server  unix:/run/php/php7.4-fpm.sock;
 }

server {
     listen 100;
     server_name magento2.dearestjanecheng.com;

     set $MAGE_ROOT /home/dev/magento2;
     set $MAGE_MODE developer;

     return 301 https://$server_name$request_uri;


     location /elasticsearch/ {
     # Pass requests to ElasticSearch
     proxy_pass http://localhost:9200/;
     proxy_redirect off;

     proxy_set_header X-Real-IP $remote_addr;
     proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
     proxy_set_header Host $http_host;

     # For CORS Ajax
     add_header Access-Control-Allow-Origin *;
     add_header Access-Control-Allow-Credentials true;
     add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';

     # Route all requests to feeds index
     rewrite ^(.*)/(.*)/(.*) /$1/$2/_search$3 break;
     rewrite_log on;
  }
}



server {

        listen 443 ssl;
        server_name magento2.dearestjanecheng.com;

        ssl_certificate /etc/letsencrypt/live/magento2.dearestjanecheng.com/fullchain.pem;
        ssl_certificate_key /etc/letsencrypt/live/magento2.dearestjanecheng.com/privkey.pem;

        #set $MAGE_MODE production;
        set $MAGE_ROOT /home/dev/magento2;
        set $MAGE_MODE developer;

        access_log /var/log/nginx/magento2-access.log;
        error_log /var/log/nginx/magento2-error.log;
        include  /home/dev/magento2/nginx.conf.sample;
}
```
```
$ ln -s /etc/nginx/sites-available/magento2 /etc/nginx/sites-enabled
```

### Commands
```
$ bin/magento setup:upgrade
$ bin/magento setup:di:compile
$ bin/magento setup:static-content:deploy -f
$ bin/magento cache:clean
$ bin/magento cache:flush
$ bin/magento module:status
$ bin/magento module:enable Module_Name
```

### Clean Magento
```
$ rm -rf pub/static/*
$ rm -rf var/generation/*
$ rm -rf cache/*
```

### Add to GitHub
```
$ git remote add origin https://github.com/JaneChengYiChen/magento2.git
$ git status
$ git config --global user.name "JaneChengYiChen"
$ git config --global user.email "freedomerest@gmail.com"
$ git commit -m 'feat:init'
$ git branch -M main
$ git push -u origin main (密碼採用 access token)

p.s. Github 目前只認 access token 所以要去設定一下
Settings > Developer settings > personal access tokens
```


### Issues
[1] unable to load /home/dev/magento2/bin/composer.json
```
Solutions(2)
1. add composer.json in var/composer_home/ with {}
2. cp composer.lock bin/composer.lock
```

[2]magento Failed to send the message. Please contact the administrator
```
Solutions(2)
1. $ bin/magento mo:di Magento_TwoFactorAuth
2. $ bin/magento module:disable Magento_TwoFactorAuth
```

[3]One or more indexers are invalid. Make sure your Magento cron job is running.
```
$ bin/magento cron:install
```

[4] ElasticeSearch cannot find node
```
$ sudo systemctl status elasticsearch

* restart
 $ sudo systemctl restart elasticsearch

Or Uninstall and Reinstall and then
 $ sudo systemctl daemon-reload
 $ sudo systemctl enable elasticsearch.service
 $ sudo systemctl start elasticsearch.service
 $ systemctl status elasticsearch
```
