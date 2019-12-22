<?php

namespace App\Http\Controllers\Api;

use App\Entity\Vote;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index()
    {
        $results = DB::select( DB::raw('select c.name as label, c.color as backgroundColor, count(v.country_id) as data from votes v join countries c on v.country_id = c.id group by c.name, c.color, v.country_id order by v.country_id') );
        // (FLOOR(1 + RAND() * 300))
        $num_results = Vote::all()->count();
        $datasets = [
            'label' => 'Всего голосов: '. $num_results,
            'backgroundColor' => [],
            'data' => [],

        ];
        $labels = [];
        foreach ($results as $item) {
            $datasets['backgroundColor'][] = $item->backgroundColor;
            $datasets['data'][] = $item->data;
            $labels[] = $item->label;
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [$datasets],
        ]);
    }

    public function unique()
    {
        $results = DB::select( DB::raw('
select
    c.name as label, c.color as backgroundColor, count(v.country_id) as data
from (select distinct country_id, finger_hash from votes) v join countries c
    on v.country_id = c.id
group by c.name, c.color, v.country_id
order by v.country_id
') );
        $datasets = [
            'label' => '',
            'backgroundColor' => [],
            'data' => [],

        ];
        $labels = [];
        foreach ($results as $item) {
            $datasets['backgroundColor'][] = $item->backgroundColor;
            $datasets['data'][] = $item->data;
            $labels[] = $item->label;
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [$datasets],
        ]);
    }
}
