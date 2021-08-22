<?php

namespace Xamel\LaravelGenerator;

class Relation
{
    protected string $result;

    public function __construct($data){
        $this->result = $this->makeRelation($data);
    }

    public function makeRelation(array $data = []) : string
    {
        $args = isset($data['args']) && count($data['args']) ?
            ', '.implode(', ', $data['args']) :
            '';
        return '$this->'.$data['type'].'('.$data['class'].'::class'.$args.');';
    }

    public function __toString(): string
    {
        return $this->result;
    }
}