<?php

namespace App\UseCases;

use App\Entity\Poll;
use App\Entity\Vote;
use App\Http\Requests\Poll\ManageRequest;
use Exception;
use Throwable;

class PollService
{
    /**
     * @param ManageRequest $request
     * @return string
     * @throws Exception|Throwable
     * @static
     */
    public function manage(ManageRequest $request): string
    {
        /** @var Poll $poll */
        $poll = Poll::all()->first();
        $result = 'Выполнено';

        switch ($request['command']):
            case ManageRequest::COMMAND_START:
                $poll->start();
                $result = 'Голосование открыто';
                break;
            case ManageRequest::COMMAND_PAUSE:
                $poll->pause();
                $result = 'Голосование закрыто';
                break;
            case ManageRequest::COMMAND_RESET:
                $poll->pause();
                Vote::query()->delete();
                $result = 'Результаты очищены';
//                $poll->reset();
        endswitch;

        $poll->saveOrFail();
        return $result;
    }

}
