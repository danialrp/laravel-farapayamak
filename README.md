# Laravel Farapayamak

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

- [Introduction](#introduction)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Support & Security](#support-security)
- [Farapayamak Documentation](https://farapayamak.ir/content/webservice)
- [License](#license)

<a name="introduction"></a>
## Introduction

By using this package you can send SMS Text Messages through Farapayamak RESTful Web Services with your Laravel application.

<a name="installation"></a>
## Installation

* Use following command to install:
```bash
composer require danialpanah/farapayamak
```
**This package supports Laravel auto-discovery feature. If you are using this feature no need any further actions required, otherwise follow below steps.**

* Add the service provider to your `providers[]` array in `config/app.php` in your laravel application: 
```php
DanialPanah\Farapayamak\FarapayamakServiceProvider::class
```

* For using Laravel Facade add the alias to your `aliases[]` array in `config/app.php` in your laravel application: 
```php
'Farapayamak': DanialPanah\Farapayamak\Facades\Farapayamak::class
```

<a name="configuration"></a>
## Configuration

* After installation, you need to add you Farapayamak settings. You can update **config/farapayamak.php** published file or in you Laravel **.env** file.

* Run the following command to publish the configuration file:
```bash
php artisan vendor:publish --provider "DanialPanah\Farapayamak\FarapayamakServiceProvider"
```

* **config/farapayamak.php**
```bash
return [
    'username' => env('FARAPAYAMAK_USERNAME', ''),
    'password' => env('FARAPAYAMAK_PASSWORD', ''),
    'from' => env('FARAPAYAMAK_FROM', '')
];
```

* Add this to `.env.example` and `.env` files:
```
#Farapayamak Credentials and settings
FARAPAYAMAK_USERNAME=
FARAPAYAMAK_PASSWORD=
FARAPAYAMAK_NUMBER=
```

<a name="usage"></a>
## Usage

Following are some ways which you can have access to farapayamak package:
```
// Importing the class namespaces before using it
use DanialPanah\Farapayamak\Farapayamak;

$data = [
   'to' => '09121111111',
   'text' => 'Test Message..'
];

$textMessage = new Farapayamak();
$response = $textMessage->send($data);
```

* Using Facades:
```
$response = Farapayamak::send($data);
```

* Sending to multiple recipients:
```
$numbers = ['09121111111', '09132222222', '09153333333'];

$data = [
   'to' => $numbers,
   'text' => 'Multicast Test Message..'
];

$response = Farapayamak::send($data);
```

<a name="support-security"></a>
## Support & Security

This plugin supports Laravel 5.8 or greater.
* In case of discovering any issues, please create one on the [Issues](https://github.com/danialrp/laravel-farapayamak/issues) section.
* For contribution, fork this repo and implements your code, then create a PR.

<a name="license"></a>
## License

This repository is an open-source software under the [MIT](https://choosealicense.com/licenses/mit/) license.


