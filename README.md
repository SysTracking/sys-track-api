# SysTracking API

Before setup api environment, you must configure database : https://github.com/SysTracking/sys-track-db

## Run in local environment

### Installation of PHP 8.2

```bash
sudo dpkg -l | grep php | tee packages.txt
sudo add-apt-repository ppa:ondrej/php # Press enter when prompted.
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-{bz2,curl,mbstring,intl}

sudo apt install php8.2-fpm

sudo a2enconf php8.2-fpm

# When upgrading from older PHP version:
sudo a2disconf php8.1-fpm

## Remove old packages
sudo apt purge php8.1*
```

### Installation of Composer

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'edb40769019ccf227279e3bdd1f5b2e9950eb000c3233ee85148944e555d97be3ea4f40c3c2fe73b22f875385f6a5155') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

sudo mv composer.phar /usr/local/bin/composer
```

Then in root of sys-track-api repository run :

```bash
composer install
```

### Configuration of environment variables

First of all .env file from .env.example

```bash
cp .env.example .env
```

Then specify in the database section the same parameter who you have configured in [sys-track-db](http://localhost.fr) .env file.

### Generate application encryption key

```bash
php artisan key:generate
```

### Run application

```bash
php artisan serve
```