<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

/**
 * Service provider for testing env
 * @author Roman Nehrulenko <roman@agently.io>
 */
class TestingServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        if (defined("IS_TESTING"))
        {
            return;
        }

        $es = new \Stats\Storage\ElasticSearch();
        $res = $es->truncate('ad.start');

        define("IS_TESTING", true);      
    }

    
}
