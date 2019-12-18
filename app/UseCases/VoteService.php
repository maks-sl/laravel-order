<?php

namespace App\UseCases;

use App\Entity\Department;
use App\Entity\Vote;
use Exception;
use App\Http\Requests\Vote\CreateRequest;
use Throwable;

class VoteService
{
    /**
     * Create Vote
     *
     * @param CreateRequest $request
     * @return mixed
     * @throws Exception|Throwable
     * @static
     */
    public function create(CreateRequest $request): Vote
    {
        $department = Department::findOrFail($request['department']);
        $winner = Department::findOrFail($request['winner']);

        /** @var Vote $vote */
        $vote = Vote::make();
        $vote->department()->associate($department);
        $vote->winner()->associate($winner);

        $vote->saveOrFail();
        return $vote;
    }

}
