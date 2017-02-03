<?php

namespace App\Http\Controllers\Report;

use \App\Http\Controllers\Controller;

/**
 * @author Roman Nehrulenko <roman@agently.io>
 */
class HistogramController extends Controller
{

    /**
     * Get histogram
     * @param  \Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function get(\Illuminate\Http\Request $request)
    {
        $input = $request->all();

        $interval = $request->input('interval');

        $validator = app('validator')->make($input, config('validation.stats.report.histogram'));

        try 
        {
            if ($validator->fails()) 
            {
                throw new \Exception($validator->messages());
            }

            $report = new \Stats\Report\Histogram;
            $report->from($this->from);
            $report->to($this->to);
            $report->filter($this->filters);
        
            $response = $report->get($input['event'], $interval);

            return response()->json($response, 200);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['Error' => $e->getMessage()], 400);
        }

        return response()->json([], 404);
    }

}