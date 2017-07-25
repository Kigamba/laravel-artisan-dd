<?php

namespace Kigamba\ArtisanDd;

use Illuminate\Console\Command;
use Spatie\TinkerTools\ShortClassNames;
class DdCommand extends Command
{
    protected $signature = 'dd {code*}';
    protected $description = 'Run the given code and dump the result';
    public function handle()
    {
        if (!$this->isAllowedToRun()) {
            $this->error('This command can only run if the environment variable `ALLOW_DD_COMMAND` is set to `true` or in local environment');
            return;
        }
        ShortClassNames::register();
        return collect($this->argument('code'))->map(function ($command) {
            return rtrim($command, ';');
        })->map(function ($sanitizedCommand) {
            return eval("dump({$sanitizedCommand});");
        })->implode(PHP_EOL);
    }
    protected function isAllowedToRun()
    {
        if (env('ALLOW_DD_COMMAND') === true) {
            return true;
        }
        return app()->environment('local');
    }
}