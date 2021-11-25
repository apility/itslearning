# ItsLearning IMS for Netflex

## Installation

```bash
composer require apility/itslearning
php artisan vendor:publish --tag=config
```

## Usage

```php
<?php

use Apility\ItsLearning\Facades\PersonManagement;

// Create a person from a Netflex Customer
PersonManagement::createPerson($customer);

// Lookup a peron by it's Netflex Customer ID
$person = PersonManagement::readPerson($customer);
```