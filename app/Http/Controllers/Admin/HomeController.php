<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $chart_options = [
            'chart_title' => __('dashboard.most_ordered'),
            'chart_type' => 'line',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Order',
'conditions' => [
        [
            'status' => 'delivered',       // Name of the column in the database
            'condition' => 'status = "delivered"',         // Condition operator
            'color' => 'black',     // Value to match (status is "delivered")
            'fill' => true,     // Value to match (status is "delivered")
        ]
    ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function'    => 'count',
'filter_field'          => 'created_at',
    'filter_days'           => 30,
    'filter_period'         => 'month',
//     'continuous_time'       => true,

        ];

        $chart1 = new LaravelChart($chart_options);
        return view('dashboard.index',compact('chart1'));
    }
}
