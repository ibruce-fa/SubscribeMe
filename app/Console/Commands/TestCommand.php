<?php

namespace App\Console\Commands;

use App\Plan;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a test script';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Running test');
        $plan = Plan::find(6);
        $newplan = $plan->toSearchArray();
        $newplan['new_field'] = " TRUE";
            // PHPUnit-style feedback
        $this->output->write($plan->toSearchArray());


        $this->info("\nDone!");

        return;
    }
}
