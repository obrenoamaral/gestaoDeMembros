<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository';
    protected $description = 'Cria um novo repository';

    public function handle()
    {
        $name = $this->ask('Give this repository a name');
        $className = $name . 'Repository';
        $namespace = 'App\\Repositories';

        $directory = app_path('Repositories/');
        $filePath = $directory . '/' . $className . '.php';

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (File::exists($filePath)) {
            $this->error("This repository {$className} exists.");
            return 1;
        }

        $template = <<<PHP
<?php

namespace {$namespace};

class {$className}
{
    //
}
PHP;

        File::put($filePath, $template);

        $this->info("Repository {$className} created successfully.");
        return 0;
    }
}
