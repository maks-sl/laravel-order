<?php

namespace App\Http\Controllers;

use App\Http\Resources\Orders\DetailResource;
use App\Http\Requests\Vote\CreateRequest;
use App\UseCases\VoteService;
use Illuminate\Http\Response;
use Throwable;

class VoteController extends Controller
{
    private $votes;

    public function __construct(VoteService $votes)
    {
        $this->votes = $votes;
    }

    public function create()
    {
        return view('vote.create');
    }

    public function store(CreateRequest $request)
    {
        try {
            $vote = $this->votes->create($request);
        } catch (Throwable $e) {
            return response()
                ->json(['errors' => 'Error creating of vote'])
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return (new DetailResource($vote))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

}
