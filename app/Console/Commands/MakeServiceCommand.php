<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $name = $this->argument('name');
        $path = app_path('Services/' . $name . 'Service.php');
        if (file_exists($path)) {
            $this->error('Service already exists');
            return;
        }
        file_put_contents($path, $this->generateServiceTemplate($name));
        $this->info('Service created successfully');
    }

    private function generateServiceTemplate($name)
    {
        return "<?php\n\nnamespace App\Services;\n\nclass {$name}Service\n{\n    //\n}";
    }
}
