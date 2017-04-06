<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Controller;
use App\Http\Requests\PulseEventRequest;

/**
 * Events tracking controller
 * @author Roman Nehrulenko <roman@agently.io>
 */
class StatsController extends Controller
{
    /**
     * @SWG\Post(
     *   path="/api/stats/pulse",
     *   summary="Pulse event",
     *   @SWG\Parameter(
     *     name="event",
     *     in="query",
     *     description="Event name.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="domain",
     *     in="query",
     *     description="Event domain.",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="url",
     *     in="query",
     *     description="Event url.",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="Successful pulse. Event saved in the storage"),
     *   @SWG\Response(response=400, description="Validation error"),
     *   @SWG\Response(response=500, description="Internal server error")
     * )
     * @param  PulseEventRequest                $request
     * @return Illuminate\Http\JsonResponse
     */
    public function pulse(PulseEventRequest $request)
    {
        try 
        {
            $logger = new \Stats\Logger;

            $resp = $logger->pulse($request->all());
        } 
        catch (\Exception $e) 
        {
            return response()->json(["Error" => $e->getMessage()], 400);
        }

        return response()->json($resp, 200);
    }

}
