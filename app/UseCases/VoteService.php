<?php

namespace App\UseCases;

use App\Entity\Country;
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
        $country = Country::findOrFail($request['winner']);

        /** @var Vote $vote */
        $request->header('User-Agent');
        $vote = Vote::make([
            'finger_hash' => $request['finger_hash'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        $vote->department()->associate($department);
        $vote->country()->associate($country);

        $vote->saveOrFail();
        return $vote;
    }

}
