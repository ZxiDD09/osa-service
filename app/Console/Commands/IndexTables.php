<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class IndexTables extends Command
{
    protected $signature = 'index:tables';

    protected $description = 'Index tables for searchability.';

    public function handle()
    {
        $models = $this->getModelsRecursively(app_path('Models'));

        foreach ($models as $modelClass) {
            Artisan::call('scout:import', ['model' => $modelClass]);
            $this->info("Imported {$modelClass}");
        }

        $this->info('All models have been imported.');
    }

    protected function getModelsRecursively($directory)
    {
        $models = [];

        $files = File::allFiles($directory);
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $modelClass = 'App\\'.str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($file->getPathname(), app_path().DIRECTORY_SEPARATOR)
                );

                if (class_exists($modelClass)) {
                    $models[] = $modelClass;
                }
            }
        }

        $subDirectories = File::directories($directory);
        foreach ($subDirectories as $subDirectory) {
            $models = array_merge($models, $this->getModelsRecursively($subDirectory));
        }

        return $models;
    }
}
