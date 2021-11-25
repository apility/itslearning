<?php

use Apility\Testing\Laravel;
use Apility\ItsLearning\Providers\ItsLearningServiceProvider;

require_once __DIR__ . '/vendor/autoload.php';

Laravel::createApplication()
    ->withDotenv(__DIR__)
    ->withConfig([
        'itslearning' => [
            'username' => env('ITSLEARNING_USERNAME'),
            'password' => env('ITSLEARNING_PASSWORD'),
            'sandbox' => env('ITSLEARNING_SANDBOX', false)
        ]
    ])
    ->withProvider(ItsLearningServiceProvider::class)
    ->boot();
