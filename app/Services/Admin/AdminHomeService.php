<?php

namespace App\Services\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminHomeService
{
    public function getChart()
    {
        $chart_options = [
            'chart_title' => __('dashboard.most_ordered'),
            'chart_type' => 'line',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Order',
            'conditions' => [
                [
                    'status' => 'delivered',
                    'condition' => 'status = "delivered"',
                    'color' => 'black',
                    'fill' => true,
                ]
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_days' => 30,
            'filter_period' => 'month',
        ];

        return new LaravelChart($chart_options);
    }
}
