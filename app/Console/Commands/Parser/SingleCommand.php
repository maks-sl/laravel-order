<?php

namespace App\Console\Commands\Parser;

use App\Entity\Parsers\Single\Parser;
use App\Jobs\SingleParserJob;
use Illuminate\Console\Command;

class SingleCommand extends Command
{
    protected $signature = 'parser:single';

    protected $description = 'Run expired single parsers';

    public function handle(): bool
    {
        $parsers = Parser::all()->where('status', Parser::STATUS_ACTIVE);

        try {
            foreach ($parsers as $parser) {
                if ($parser->isExpired()) {
                    SingleParserJob::dispatch($parser, true);
                    $this->info('Add job for Single Parser '.$parser->id);
                }
            }
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
            return false;
        }
        return true;
    }
}
