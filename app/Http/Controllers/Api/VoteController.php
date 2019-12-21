<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index()
    {
        $results = DB::select( DB::raw('select c.name as label, c.color as backgroundColor, count(v.country_id) as data from votes v join countries c on v.country_id = c.id group by c.name, c.color, v.country_id order by v.country_id') );
        $datasets = array_map(function ($item) {
            return [
                'label' => $item->label,
                'backgroundColor' => $item->backgroundColor,
                'data' => [$item->data],
            ];
        }, $results);

        return response()->json([
            'labels' => ['Votes count'],
            'datasets' => $datasets,
        ]);
    }
}
