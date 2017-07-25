<?php

namespace Kigamba\ArtisanDd\Test;

use Kigamba\ArtisanDd\DdCommand;
use Illuminate\Support\ServiceProvider;
class ArtisanDdServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('command.dd', DdCommand::class);
        $this->commands(['command.dd']);
    }
}