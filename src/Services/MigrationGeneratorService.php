<?php

namespace Xamel\LaravelGenerator\Services;

use Xamel\LaravelGenerator\MigrationSchema;

class MigrationGeneratorService
{
    public function makeUpMethod($table) : string
    {
        return new MigrationSchema($table, 'create');
    }

    public function makeDownMethod($table) : string
    {
        return new MigrationSchema($table, 'dropIfExists');
    }
}