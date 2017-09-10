Searcher module
===================
 - Frontend - vuejs
 - Backend - Hand made MVC
 - BD - postgresql
 
Used dependencies
===================
- Eloquent ORM 
- phpdotenv (for environment configs)
- valitron (for request validation)

----------
## Nginx config example ##

```
#!nginx

server {
    charset utf-8;
    client_max_body_size 128M;

    listen 80;

    server_name searcher.dev;
    root        /var/www/searcher/public;
    index       index.php;

    access_log  /var/log/nginx/searcher.dev.access.log;
    error_log   /var/log/nginx/searcher.dev.error.log;
    
    include	cors;

    location / {
        #
        # CORS
        #
         if ($request_method = 'OPTIONS') {
            add_header 'Access-Control-Allow-Origin' '*';
            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
            add_header 'Access-Control-Allow-Headers' 'DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range';
            add_header 'Access-Control-Max-Age' 1728000;
            add_header 'Content-Type' 'text/plain; charset=utf-8';
            add_header 'Content-Length' 0;
            return 204;
         }

        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
	fastcgi_pass unix:/run/php/php7.0-fpm.sock;
    include	  fastcgi_params;
	fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
        try_files $uri =404;
    }

    location ~ /\.(ht|svn|git) {
        deny all;
    }
}


```

## Init backend ##

```
#install composer dependencies
composer install

#execute migration migration
/migration/db.sql

#add environment
app/.env
```

## Init frontend ##

```
#build front
yarn

#for production
yarn build

#for development
yarn dev
```