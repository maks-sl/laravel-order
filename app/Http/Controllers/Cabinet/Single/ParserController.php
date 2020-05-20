<?php

namespace App\Http\Controllers\Cabinet\Single;

use App\Entity\Parsers\Single\Parser;
use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Parsers\SingleRequest;
use App\Jobs\SingleParserJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParserController extends Controller
{
    public function index(Request $request)
    {
        $parsers = Parser::forUser(Auth::user())->orderByDesc('id')->paginate(20);

        return view('cabinet.single.parser.index', compact('parsers'));
    }

    public function create()
    {
        return view('cabinet.single.parser.create');
    }

    public function store(SingleRequest $request)
    {
        /** @var User $user */
        $user = User::findOrFail(\Auth::id());

        $parser = Parser::make([
            'name' => $request['name'],
            'url' => $request['url'],
            'css_path' => $request['css_path'],
            'regex' => $request['regex'],
            'match_group' => $request['match_group'],
            'strip_tags' => (bool)$request['strip_tags'],
            'period' => $request['period'],
            'status' => Parser::STATUS_PAUSED,
        ]);

        $parser->user()->associate($user);
        $parser->saveOrFail();

        return redirect()->route('cabinet.single.parser.show', $parser);
    }

    public function show(Parser $parser)
    {
        return view('cabinet.single.parser.show', compact('parser'));
    }

    public function edit(Parser $parser)
    {
        return view('cabinet.single.parser.edit', compact('parser'));
    }

    public function update(SingleRequest $request, Parser $parser)
    {
        $parser->update($request->only(['name', 'url', 'css_path', 'regex', 'match_group', 'period']));
        $parser->update(['strip_tags'=> (bool)$request['strip_tags']]);
        return redirect()->route('cabinet.single.parser.show', $parser);
    }

    public function destroy(Parser $parser)
    {
        $parser->delete();

        return redirect()->route('cabinet.single.parser.index');
    }

    public function activate(Parser $parser)
    {
        $parser->activate();

        return redirect()->back()->with('success', 'Parser '.$parser->id.' is activated');
    }

    public function pause(Parser $parser)
    {
        $parser->pause();

        return redirect()->back()->with('success', 'Parser '.$parser->id.' is paused');
    }

    public function run(Parser $parser)
    {
        SingleParserJob::dispatch($parser);

        return redirect()->back()->with('success', 'Added to queue');
    }

}
