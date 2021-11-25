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

    public function getIdAttribute()
    {
        return $this->attributes['userId']['userIdValue'];
    }

    public function getFirstnameAttribute()
    {
        $parts = Collection::make($this->attributes['name']['partName']);
        $firstNamePart = $parts->first(fn ($part) => $part['namePartType'] === 'First');

        if ($firstNamePart) {
            return $firstNamePart['namePartValue'];
        }
    }

    public function getLastnameAttribute()
    {
        $parts = Collection::make($this->attributes['name']['partName']);
        $lastNamePart = $parts->first(fn ($part) => $part['namePartType'] === 'Last');

        if ($lastNamePart) {
            return $lastNamePart['namePartValue'];
        }
    }

    public function getNameAttribute()
    {
        return implode(' ', array_filter([
            $this->getFirstnameAttribute(),
            $this->getLastnameAttribute()
        ]));
    }

    public function getRoleAttribute()
    {
        return $this->attributes['institutionRole']['institutionRoleType'];
    }
}
