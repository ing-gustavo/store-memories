<?php

namespace App\Providers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\ServiceProvider;
use Artesaos\SEOTools\Facades\OpenGraph;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        SEOTools::macro('webPage', function (string $title, string $description,string $canonical = "") {
            SEOMeta::setTitle($title);
            SEOMeta::setDescription($description);
            if($canonical != "")
            {
                SEOMeta::setCanonical($canonical);
            }

            OpenGraph::setDescription($description);
            OpenGraph::setTitle($title);
            if($canonical != "")
            {
                OpenGraph::setUrl($canonical);
            }
            OpenGraph::addProperty('type', 'webpage');
        });
    }
}
