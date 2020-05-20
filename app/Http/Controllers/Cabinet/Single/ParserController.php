<?php

namespace App\Http\Controllers\Cabinet\Single;

use App\Entity\Parsers\Single\Parser;
use App\Entity\Parsers\Single\Result;
use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Parsers\SingleRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\DomCrawler\Crawler;

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
        $html = file_get_contents($parser->url);

        $crawler = new Crawler(null, $parser->url);
        $crawler->addHtmlContent($html, 'UTF-8');
        $text = $crawler->filter($parser->css_path)->text(null, true);

        if ($parser->strip_tags) {
            $text = strip_tags($text);
        }

        if ($parser->regex) {
            $re = '/'.$parser->regex.'/m';
            preg_match_all($re, $text, $matches, PREG_SET_ORDER, 0);

            if (empty($matches)) {
                throw new \RuntimeException('Regex does not match the selector content');
            }

            if ($lev = $parser->match_group) {
                if (!isset($matches[0][$lev])) {
                    throw new \RuntimeException('Invalid level of regexp matches');
                }
                $value = $matches[0][$lev];
            } else {
                $value = $matches[0][0];
            }
        }

        $result = Result::make([
            'value' => $value ?? $text,
        ]);
        $result->setCreatedAt(Carbon::now());
        $result->parser()->associate($parser);
        $result->saveOrFail();

        return redirect()->back()->with('success', 'Result '.$result->id.' added');
    }

}
