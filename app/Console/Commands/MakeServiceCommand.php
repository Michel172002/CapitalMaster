<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
        $name = $this->argument('name');
        $name = Str::studly(str_replace('Service', '', $name));
        $className = $name . 'Service';
        $path = app_path('Services/' . $className . '.php');
        
        if (file_exists($path)) {
            if (!$this->confirm('O arquivo já existe. Deseja sobrescrever?')) {
                $this->info('Operação cancelada.');
                return 0;
            }
        }
        
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        
        file_put_contents($path, $this->generateServiceTemplate($name));
        $this->info("Service {$className} criado com sucesso em {$path}");
        
        return 0;
    }

    private function generateServiceTemplate($name)
    {
        return "<?php

namespace App\Services;

class {$name}Service
{
    public function __construct()
    {
        //
    }

    // Implemente os métodos do seu serviço aqui
}";
    }
}
