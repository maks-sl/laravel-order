<?php

namespace App\Http\Controllers;

use App\Http\Resources\Orders\DetailResource;
use App\Http\Requests\Vote\CreateRequest;
use App\UseCases\VoteService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Throwable;

class VoteController extends Controller
{
    private $votes;

    public function __construct(VoteService $votes)
    {
        $this->votes = $votes;
    }

    public function create(Request $request)
    {
        if (!$request->session()->exists('vote_counted')) {
            return view('vote.create');
        } else {
            return view('vote.chart');
        }
    }

    public function store(CreateRequest $request)
    {
        if (!$request->session()->exists('vote_counted')) {
            try {
                $vote = $this->votes->create($request);
                $request->session()->put('vote_counted', true);
            } catch (Throwable $e) {
                return response()
                    ->json(['errors' => 'Error creating of vote'])
                    ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            return (new DetailResource($vote))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        }
        return response()
            ->json(['errors' => 'Thanks for you vote!'])
            ->setStatusCode(Response::HTTP_LOCKED);

    }

    public function chart()
    {
        return view('vote.chart');
    }
}
