<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class VoteController extends Controller
{
    public function index()
    {
        return response()->json([
            'labels' => ['00:10', '00:20', '00:30', '00:40'],
            'datasets' => [
                [
                    'label' => 'A',
                    'backgroundColor' => '#FF894F',
                    'data' => [rand(0,2), rand(2,5), rand(5,7), rand(8,11)]
                ],
                [
                    'label' => 'B',
                    'backgroundColor' => '#1d643b',
                    'data' => [rand(0,1), rand(2,6), rand(6,8), rand(8,10)]
                ],
            ],
        ]);
    }
}
