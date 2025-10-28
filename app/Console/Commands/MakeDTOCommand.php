<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeDTOCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dto {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new DTO (Data Transfer Object) class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $name = Str::studly(str_replace('DTO', '', str_replace('Dto', '', $name)));
        $className = $name . 'DTO';
        $path = app_path('DTOs/' . $className . '.php');
        
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
        
        file_put_contents($path, $this->generateDTOTemplate($name));
        $this->info("DTO {$className} criado com sucesso em {$path}");
        
        return 0;
    }

    private function generateDTOTemplate($name)
    {
        return "<?php

namespace App\DTOs;

class {$name}DTO
{
    public function __construct(
        //
    ) {
        //
    }

    /**
     * Cria uma instância do DTO a partir de um array
     */
    public static function fromArray(array \$data): self
    {
        return new self(
            // Adicione os parâmetros aqui
        );
    }

    /**
     * Converte o DTO para array
     */
    public function toArray(): array
    {
        return [
            // Adicione os campos aqui
        ];
    }

    /**
     * Converte o DTO para JSON
     */
    public function toJson(): string
    {
        return json_encode(\$this->toArray());
    }
}";
    }
}

