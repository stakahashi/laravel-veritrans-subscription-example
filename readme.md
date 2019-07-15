# Laravel Veritrans Subscription Example

## Get Started

### Install

```
$ composer install
```

### .env

```
#DB_CONNECTION=mysql
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=homestead
#DB_USERNAME=homestead
#DB_PASSWORD=secret
DB_CONNECTION=sqlite
```

### Database Configuration

```
$ touch database/database.sqlite
$ ./artisan migrate --seed
```

### Run

```
$ ./artisan serve
```

## Veritrans Configuration

### Library

### ex. Veritrans 3G

```
$ tree app/Vendors/ -L 3
app/Vendors/
└── tgMdkPHP
    ├── README.txt
    ├── js
    │   └── tradv2.js
    ├── resources
    │   └── cert.pem
    └── tgMdk
        ├── 3GPSMDK.php
        ├── 3GPSMDK.properties
        ├── Lib
        └── log4php.properties
```

### 3GPSMDK.properties

```
MERCHANT_CC_ID                 = 
MERCHANT_SECRET_KEY            = 
```

### log4php.properties

```
log4php.appender.R1.File=/path/to/mdk_php.log
```
