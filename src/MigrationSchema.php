<?php

namespace Xamel\LaravelGenerator;

use Illuminate\Support\Str;

class MigrationSchema
{
    protected string $lineEnd = "\r\n";

    public function __construct(protected $table, protected $method){}

    public function getTableName() : string
    {
        if(isset($this->table['properties']['table']) && $this->table['properties']['table'])
            return $this->table['properties']['table'];

        return Str::snake($this->table['name']);
    }

    public function create() : string
    {
        $content = '"'.$this->getTableName().'", function(Blueprint $table) {'.$this->lineEnd;
        array_map(function($field) use (&$content){
            $content .= new MigrationField($field)."\r\n";
        },$this->table['fields']);
        $content .= '}';

        return $content;
    }

    public function dropIfExists() : string
    {
        return '"'.$this->getTableName().'"';
    }

    public function __toString()
    {
        return 'Schema::'.$this->method.'('.$this->{$this->method}().');';
    }
}