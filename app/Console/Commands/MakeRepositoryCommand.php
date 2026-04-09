<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRepositoryCommand extends GeneratorCommand
{
    protected $signature = 'make:repository {name}';

    protected $description = 'Create a new Repository class';

    protected $type = 'Repository';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/repository.stub');
    }

    protected function resolveStubPath(string $stub): string
    {
        $customPath = $this->laravel->basePath(trim($stub, '/'));

        return file_exists($customPath) ? $customPath : __DIR__.$stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Repositories';
    }
}
