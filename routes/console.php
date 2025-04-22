<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {

    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('create-daily-attendance')
    ->dailyAt('18:30')
    ->runInBackground();
