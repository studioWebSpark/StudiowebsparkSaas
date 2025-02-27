<?php

namespace App\Console\Commands;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('https://studiowebspark.fr')
                ->setLastModificationDate(now())
                ->setChangeFrequency('daily')
                ->setPriority(1.0))
            ->add(Url::create('https://studiowebspark.fr/about')
                ->setLastModificationDate(now())
                ->setChangeFrequency('monthly')
                ->setPriority(0.8))
            // Ajoutez d'autres URLs ici
            ->add(Url::create('https://studiowebspark.fr/contact')
                ->setLastModificationDate(now())
                ->setChangeFrequency('monthly')
                ->setPriority(0.8));

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
