<?php

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * Generate events
     * @param  array    $input     
     * @param  integer  $timestamp
     * @param  integer  $count    
     * @return array            
     */
    public function generate($input, $timestamp, $count = 1)
    {
        $resp = [];

        $logger = new \Stats\Logger;
        
        for ($i = 0; $i < $count; $i++) 
        { 
            $logger->setTimestamp($timestamp);
            $resp[] = $logger->pulse($input);
        } 

        return $resp;
    }

    /**
     * Truncate storage
     * @param  string   $type
     * @return void      
     */
    public function truncateStorage($type)
    {
        \Stats\Storage\Factory::make()->truncate($type); 
    }
    
}
