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

        // Truncate all test index types
        $es = new \Stats\Storage\ElasticSearch;

        $types = config('database.types');

        foreach ($types as $t) 
        {
            $es->truncate($t);
        }

        define("IS_TESTING", true);      
    }

    
}
