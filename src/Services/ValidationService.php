<?php

namespace Xamel\LaravelGenerator\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Xamel\LaravelGenerator\Exceptions\ValidationException;

class ValidationService
{
    // TODO add morphTo
    protected array $relations = [
        'belongsTo',
        'belongsToMany',
        'hasOne',
        'hasMany',
        'hasOneThrough',
        'hasManyThrough',
        'morphOne',
        'morphMany',
        'morphedByMany'
    ];

    protected array $fieldTypes = [
        'bigIncrements',
        'bigInteger',
        'binary',
        'boolean',
        'char',
        'dateTimeTz',
        'dateTime',
        'date',
        'decimal',
        'double',
        'enum',
        'float',
        'foreignId',
        'foreignUuid',
        'geometryCollection',
        'geometry',
        'id',
        'increments',
        'integer',
        'ipAddress',
        'json',
        'jsonb',
        'lineString',
        'longText',
        'macAddress',
        'mediumIncrements',
        'mediumInteger',
        'mediumText',
        'morphs',
        'multiLineString',
        'multiPoint',
        'multiPolygon',
        'nullableMorphs',
        'nullableTimestamps',
        'nullableUuidMorphs',
        'point',
        'polygon',
        'rememberToken',
        'set',
        'smallIncrements',
        'smallInteger',
        'softDeletesTz',
        'softDeletes',
        'string',
        'text',
        'timeTz',
        'time',
        'timestampTz',
        'timestamp',
        'timestampsTz',
        'timestamps',
        'tinyIncrements',
        'tinyInteger',
        'tinyText',
        'unsignedBigInteger',
        'unsignedDecimal',
        'unsignedInteger',
        'unsignedMediumInteger',
        'unsignedSmallInteger',
        'unsignedTinyInteger',
        'uuidMorphs',
        'uuid',
        'year'
    ];

    public function validate($data = []){

        $validator = Validator::make($data, [
            '*.name' => 'required',
            '*.fields' => 'required|array',
            '*.fields.*.name' => 'required',
            '*.fields.*.type' => [
                'required',
                Rule::in($this->fieldTypes)
            ],
            '*.relations.*.class' => 'required',
            '*.relations.*.type' => [
                'required',
                Rule::in($this->relations)
            ],
        ]);
        if($validator->fails()) {
            throw new ValidationException('Class validation failed');
        }
    }
}