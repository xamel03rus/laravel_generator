<?php

namespace Xamel\LaravelGenerator\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;

class LaravelGeneratorService
{
    public function processData(array $classes = [], string $classPath = 'app/Models/', string $migrationPath = 'database/migrations/')
    {
        $this->checkDirectory($classPath);
        $this->checkDirectory($migrationPath);
        app(ValidationService::class)->validate($classes);

        foreach($classes as $class) {
            $this->generateClassFile($class, $classPath);
        }

        $this->generateMigrations($classes, $migrationPath);
    }

    private function checkDirectory(string $path)
    {
        if(!file_exists($path)){
            mkdir($path);
        }
    }

    private function generateClassFile(array $data,string $classPath)
    {
        $class = app(ClassGeneratorService::class)->makeClass($data);

        $namespace = new PhpNamespace('App\Models');
        $namespace->addUse(Model::class, 'Model');
        $namespace->add($class);

        $file = new PhpFile();
        $file->addNamespace($namespace);
        file_put_contents($classPath.Str::studly($data['name']).'.php', $file);
    }

    private function generateMigrations(array $data, string $migrationPath)
    {
        /** @var MigrationGeneratorService $service */
        $service = app(MigrationGeneratorService::class);

        $namespace = new PhpNamespace('');
        $class = new ClassType('XamelLaravelGeneratorMigrations');
        $class->setExtends(Migration::class);
        $up = $class->addMethod('up');
        $down = $class->addMethod('down');
        $namespace->add($class);
        $namespace->addUse('Illuminate\Database\Migrations\Migration');
        $namespace->addUse('Illuminate\Database\Schema\Blueprint');
        $namespace->addUse('Illuminate\Support\Facades\Schema');

        array_map(function ($table) use ($service, $up, $down){
            $up->addBody($service->makeUpMethod($table));
            $down->addBody($service->makeDownMethod($table));
        }, $data);

        $file = new PhpFile();
        $file->addNamespace($namespace);
        file_put_contents($migrationPath.date('Y_m_d')."_".substr(time(), 0, 6)."_xamel_laravel_generator_migrations.php", $file);
    }
}