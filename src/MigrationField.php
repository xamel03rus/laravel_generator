<?php

namespace Xamel\LaravelGenerator;

class MigrationField
{
    public function __construct(protected $data) {}

    public function __toString()
    {
        return '    $table->'.$this->data['type'].'("'.$this->data['name'].'");';
    }
}