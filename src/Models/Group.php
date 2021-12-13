<?php

namespace Apility\ItsLearning\Models;

use Netflex\Support\Accessors;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $role
 */
class Person
{
    use Accessors;

    public function __construct($data)
    {
        $this->attributes = json_decode(json_encode($data), true);
    }
}
