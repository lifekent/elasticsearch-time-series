<?php

namespace App\Http\Controllers\Report;

use \App\Http\Controllers\Controller;
use App\Http\Requests\HistogramReportRequest;

/**
 * @author Roman Nehrulenko <roman@agently.io>
 */
class HistogramController extends Controller
{

    /**
     * @SWG\Get(
     *   path="/api/report/histogram",
     *   summary="Get events count histogram",
     *   @SWG\Parameter(
     *     name="event",
     *     in="query",
     *     description="Event name.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="interval",
     *     in="query",
     *     description="Histogram interval: year, quarter, month, week, day, hour, minute, second",
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
     *       description="Report with the events count histogram",
     *       @SWG\Schema(
     *           type="array"
     *       )
     *   ),
     *   @SWG\Response(response=400, description="Validation error"),
     *   @SWG\Response(response=500, description="Internal server error")
     * )
     * @param  HistogramReportRequest           $request
     * @return Illuminate\Http\JsonResponse
     */
    public function get(HistogramReportRequest $request)
    {
        try 
        {
            $report = new \Stats\Report\Histogram;
            $report->from($this->from);
            $report->to($this->to);
            $report->filter($this->filters);
        
            $response = $report->get($request->input('event'), $request->input('interval'));

            return response()->json($response, 200);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['Error' => $e->getMessage()], 400);
        }

        return response()->json([], 404);
    }

}