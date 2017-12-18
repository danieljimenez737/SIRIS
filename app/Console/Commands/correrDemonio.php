<?php

namespace App\Console\Commands;
use Htmldom;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\traits\htmlTrait;
class correrDemonio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:demonio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se ha corrido el demonio';
    protected $html;

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
       
         Log::info("Demonio ejecuantose");
        htmlTrait::start();
    }
    
    
}
