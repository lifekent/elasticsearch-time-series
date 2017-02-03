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
     * Get count
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