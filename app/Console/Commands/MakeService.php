<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    protected $signature = 'make:service';
    protected $description = 'Cria um novo Service de API';

    public function handle()
    {
        $name = $this->ask('Give this service a name');
        $className = $name . 'Service';
        $namespace = 'App\\Services';

        $directory = app_path('Services/');
        $filePath = $directory . '/' . $className . '.php';

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (File::exists($filePath)) {
            $this->error("This Service {$className} exists.");
            return 1;
        }

        $template = <<<PHP
<?php

namespace {$namespace};

class {$className}
{
    public function __construct()
    {
        //
    }
}
PHP;

        File::put($filePath, $template);

        $this->info("Service {$className} created successfully.");
        return 0;
    }
}
