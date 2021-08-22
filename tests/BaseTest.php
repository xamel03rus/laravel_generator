<?php
namespace Xamel\LaravelGenerator\Tests;

use Orchestra\Testbench\TestCase;
use Xamel\LaravelGenerator\Services\LaravelGeneratorService;

class BaseTest extends TestCase
{
    public function testParsingClassDefinition()
    {
        $jsonClass = [
            "name" => 'SimpleModel',
            'fields' => [
                [
                    'name' => 'id',
                    'type' => 'integer',
                    'props' => []
                ],
                [
                    'name' => 'name',
                    'type' => 'string',
                    'props' => []
                ]
            ],
            'properties' => [
                'table' => 'simple_models',
                'guarded' => ['id'],
                'fillable' => [],
            ],
            "relations" => [
                [
                    'name' => 'users',
                    'type' => 'belongsTo',
                    'class' => 'HardModel'
                ]
            ]
        ];

        if(!file_exists('tests/files/')){
            mkdir('tests/files/');
        }
        $this->assertDirectoryExists("tests/files/");

        app(LaravelGeneratorService::class)->processData([$jsonClass], 'tests/files/Models/', 'tests/files/migrations/');

        $this->assertFileExists('tests/files/Models/SimpleModel.php');
    }

    public function testFailingOnValidate()
    {
        $jsonClass = [
            'fields' => [
                [
                    'name2' => 'id',
                    'type1' => 'integer',
                    'props3' => []
                ],
            ]
        ];

        try {
            app(LaravelGeneratorService::class)->processData([$jsonClass], 'tests/files/Models/', 'tests/files/migrations/');
            $this->assertTrue(false);
        } catch (\Throwable $ex) {
            $this->assertTrue(true);
        }
    }
}