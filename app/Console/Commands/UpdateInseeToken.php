<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateInseeToken extends Command
{
    protected $signature = 'insee:update-token';
    protected $description = 'Met à jour le token INSEE';

    public function handle()
    {
        try {
            $consumerKey = config('services.insee.consumer_key');
            $consumerSecret = config('services.insee.consumer_secret');

            $response = Http::withBasicAuth($consumerKey, $consumerSecret)
                ->asForm()
                ->post('https://api.insee.fr/token', [
                    'grant_type' => 'client_credentials'
                ]);

            if ($response->successful()) {
                $token = $response->json('access_token');

                // Mise à jour du fichier .env
                $this->updateEnvFile('INSEE_API_TOKEN', $token);

                $this->info('Token INSEE mis à jour avec succès !');
                return Command::SUCCESS;
            }

            $this->error('Erreur lors de la récupération du token');
            return Command::FAILURE;
        } catch (\Exception $e) {
            $this->error('Erreur : ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    private function updateEnvFile($key, $value)
    {
        $path = base_path('.env');
        $content = file_get_contents($path);

        if (strpos($content, $key) !== false) {
            file_put_contents($path, preg_replace(
                "/^{$key}=.*/m",
                "{$key}={$value}",
                $content
            ));
        } else {
            file_put_contents($path, $content . "\n{$key}={$value}\n");
        }
    }
}
