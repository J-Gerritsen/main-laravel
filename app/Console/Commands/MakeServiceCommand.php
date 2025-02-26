<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get the service name from the command line argument
        $name = $this->argument('name');

        // prepare the service class path
        $serviceDirectory = app_path('Services');
        $serviceClassName = Str::studly($name);
        $serviceFilePath = "{$serviceDirectory}/{$serviceClassName}.php";

        // check and create the service directory if it doesn't exist
        if (!File::exists($serviceDirectory)) {
            File::makeDirectory($serviceDirectory, 0755, true);
            $this->info('Service directory created: ' . $serviceDirectory);
        }

        // check if the service class already exists
        if (File::exists($serviceFilePath)) {
            $this->error("Service '$serviceClassName' already exists.");
            return;
        }

        // create the service class file from stub/template
        $stub = <<<PHP
<?php

namespace App\Services;

class {$serviceClassName}
{
    //
}
PHP;

        File::put($serviceFilePath, $stub);

        // display success message
        $this->info("Service '$serviceClassName' created successfully.");
    }
}
