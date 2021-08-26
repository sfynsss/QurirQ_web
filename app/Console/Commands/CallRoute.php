<?php

namespace Larisso\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CallRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:call {route}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call route from CLI';

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
        $request = Request::create(route($this->argument('route')), 'GET');
        $response = app()->handle($request);
        $responseBody = $response->getContent();
        $this->info($this->argument('route') . ' route has been dispatched successfully');
    }
}