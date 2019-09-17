# Hexagonal architecture

An example of hexagonal architecture with a modern MVC PHP project without framework.
 
PHP7.3, PHPUNIT, TWIG, HTML, CSS, COMPOSER, GIT. 

## Checkout application

Clone this repository:

```bash
git clone https://github.com/oumarkonate/hexagonal-architecture.git
```

## Installation

* First install composer at project root. Run the following script in your terminal:

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
Read more about composer installation: https://getcomposer.org/download/

* Then install composer dependencies:
```bash
composer install
```
## Run application

* Launch in a terminal the following command to run php internal web server:
```bash
php -S localhost:8000
```

* Access the project via browser : 

> Home page:
> - http://localhost:8000/

> Image gallery page:
> - http://localhost:8000/gallery-images/
> - http://localhost:8000/gallery-images/?page=2&size=5

## Run unit tests

* Launch in a terminal the following command:
```bash
./vendor/bin/phpunit tests/ --colors
```


