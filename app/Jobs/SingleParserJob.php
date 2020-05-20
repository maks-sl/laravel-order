<?php

namespace App\Jobs;

use App\Entity\Parsers\Single\Parser;
use App\Entity\Parsers\Single\Result;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\DomCrawler\Crawler;

class SingleParserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $parser;
    private $checkPeriod;

    public function __construct(Parser $parser, $checkPeriod = false)
    {
        $this->parser = $parser;
        $this->checkPeriod = $checkPeriod;
    }

    public function handle()
    {
        $parser = $this->parser;

        if ($this->checkPeriod) {
            if (!$parser->isExpired()) {
//                throw new \RuntimeException('Parser is no expired')
                return;
            }
        }

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
    }
}
