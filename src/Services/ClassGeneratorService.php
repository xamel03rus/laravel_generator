<?php

namespace Xamel\LaravelGenerator\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Xamel\LaravelGenerator\Relation;

class ClassGeneratorService
{
    public function makeClass(array $data) : ClassType
    {
        $class = new ClassType(Str::studly($data['name']));
        $class->setExtends(Model::class);

        if(isset($data['properties']) && !empty($data['properties'])) {
            array_map(function($value, $name) use ($class) {
                $property = $class->addProperty($name);
                $property->setProtected();
                $property->setValue($value);
            }, $data['properties'], array_keys($data['properties']));
        }

        array_map(function($relation) use ($class){
            $this->addRelation($class, $relation);
        }, $data['relations']);

        return $class;
    }

    public function addRelation(ClassType $class, $data) : ClassType
    {
        $name = isset($data['name']) ? $data['name'] : lcfirst($data['type']);

        $relation = $class->addMethod($name);
        $relation->addBody(new Relation($data));

        return $class;
    }
}