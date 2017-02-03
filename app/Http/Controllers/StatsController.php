<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Controller;

/**
 * Events tracking controller
 * @author Roman Nehrulenko <roman@agently.io>
 */
class StatsController extends Controller
{
    /**
     * Pulse event
     * @param  \Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function pulse(\Illuminate\Http\Request $request)
    {
        $input = $request->all();

        $validator = app('validator')->make($input, config('validation.stats.track.pulse'));

        try 
        {
            if ($validator->fails()) 
            {
                throw new \Stats\Exceptions\BadPulseException($validator->messages());
            }
            
            $logger = new \Stats\Logger;

            $resp = $logger->pulse($input);
        } 
        catch (\Exception $e) 
        {
            app('log')->error($e->getMessage());

            return response()->json(["Error" => $e->getMessage()], 400);
        }

        return response()->json($resp, 200);
    }

}
