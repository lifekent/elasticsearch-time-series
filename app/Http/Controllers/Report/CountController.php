<?php

namespace App\Http\Controllers\Report;

use \App\Http\Controllers\Controller;

/**
 * Count controller
 * Request params must be a JSON string
 * API documentation available with http://apidocjs.com/
 * @author Roman Nehrulenko <roman@agently.io>
 */
class CountController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/api/report/count",
     *   summary="Get events count",
     *   @SWG\Parameter(
     *     name="event",
     *     in="query",
     *     description="Event name.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="filters",
     *     in="query",
     *     description="Report filters.",
     *     required=false,
     *     type="array",
     *     @SWG\Items(type="string"),
     *     collectionFormat="multi"
     *   ),
     *   @SWG\Response(
     *       response=200, 
     *       description="Report with the events count.",
     *       @SWG\Schema(
     *           type="array"
     *       )
     *   ),
     *   @SWG\Response(response=400, description="Validation error"),
     *   @SWG\Response(response=500, description="Internal server error")
     * )
     * @param  \Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function get(\Illuminate\Http\Request $request)
    {
        $input = $request->all();

        $validator = app('validator')->make($input, config('validation.stats.report.count'));

        try 
        {
            if ($validator->fails()) 
            {
                throw new \Exception($validator->messages());
            }

            $report = new \Stats\Report\Count;
            $report->from($this->from);
            $report->to($this->to);
            $report->filter($this->filters);

            $response = [
                'total' => $report->get($input['event']),
            ];
        } 
        catch (\Exception $e) 
        {
            return response()->json(['Error' => $e->getMessage()], 400);
        }

        return response()->json($response, 200);
    }

}