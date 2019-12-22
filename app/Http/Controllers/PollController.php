<?php

namespace App\Http\Controllers;

use App\Entity\Poll;
use App\Http\Requests\Poll\ManageRequest;
use App\UseCases\PollService;
use Illuminate\Http\Request;
use Throwable;

class PollController extends Controller
{
    private $polls;

    public function __construct(PollService $polls)
    {
        $this->polls = $polls;
    }

    public function index(Request $request)
    {
        $poll = Poll::all()->first();
        return view('poll.index', compact('poll'));
    }

    public function manage(ManageRequest $request)
    {
        try {
            $result_text = $this->polls->manage($request);
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка обработки запроса');
        }
        return redirect()->route('poll.index')->with('status', $result_text);

    }

}
