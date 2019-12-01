# TopUpHandler
A PHP wrapper for Legacy API

## Requirements
* PHP >= 7.1.3
* OpenSSL PHP Extension
* To use the PHP stream handler, `allow_url_fopen` must be enabled in your system's php.ini.
* To use the `cURL` handler, you must have a recent version of cURL >= 7.19.4 compiled with `OpenSSL` and `zlib`.
* [Composer](https://getcomposer.org/) dependency manager

## Installation
#### 1. Clone the repo
To install the project you should take a clone from the repository in your local with below command:
```
git clone git@github.com:mostafasoufi/TopUpHandler.git
```

Then go to project with `cd`
```
cd TopUpHandler
```

#### 2. Install packages & dependencies
Then try to install all packages with the composer:
```
composer install
```

## Usage
#### Autoloading
TopUpHandler supports both PSR-0 as PSR-4 autoloaders.
```php
# When installed via composer
require_once 'vendor/autoload.php';

use TopUpHandler\TopUpHandler;

$top = new TopUpHandler();
```

#### Get Balance
```php
$balance = $top->getBalance(37250123123);

// Get the blocked status.
echo $balance->isBlocked();

// Get the response.
print_r($balance->response();
```

#### Charge a Number
```php
// Charge the number.
$charge = $top->addBalance(3725123123, 'USD', 1000);

// Get the response.
print_r($charge->response();
```

#### Configuration
You can configuration many items before the requests.
```
$config = array(
    'api' => [
        'url' => 'https://legacyapi.example.com', // API address, default is http://localhost:3001
        'credential' => ['admin', 'waGQeCLNjZ7'] // Username and Password, default is admin 123456
    ],
    'notifications' => [
        'email' => [
            'enabled' => false, // Status
            'message' => 'Hello,<br />Now problem happened, here are the information of problem.<br />Mobile number: %number%<br />Response: %response%<br />Status Code: %statusCode%', // Message with variables.
            'recipients' => ['devops@example.com', 'support@example.com'] // An array for getting email, first key for to and second key for CC.
        ],
        'sms' => [
            'enabled' => false,
            'message' => 'Hello,\n here are the problem.\n Number: %number% \n Response: %response% \n Status Code: %',
        ]
    ]
);

$top = new TopUpHandler($config);
```

## Unit Test
Unix area:
```
vendor/bin/phpunit
```

Windows area:
```
vendor\bin\phpunit
```
