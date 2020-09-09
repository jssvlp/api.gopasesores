<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository with its contract interface';

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
        dd($this->argument('name'));
        $this->info('Done!');
    }


    private function createConctractInterface()
    {

    }

    private function createRepository()
    {

    }

    //The root location the file should be written to
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\App\Repositories';
    }
}
