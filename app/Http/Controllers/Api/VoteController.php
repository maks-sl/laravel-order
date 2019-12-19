<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index()
    {
        $results = DB::select( DB::raw('select d.name as label, d.color as backgroundColor, count(winner_id) as data from votes v join departments d on v.winner_id = d.id group by d.name order by v.winner_id') );
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
