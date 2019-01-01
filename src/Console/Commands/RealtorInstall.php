<?php

namespace DesignByCode\Realtor\Console\Commands;

use function base_path;
use function file_exists;
use Illuminate\Console\Command;

class RealtorInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'realtor:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup realtor for the first time';

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
        $this->removeAuth();
    }

    public function removeAuth()
    {

    }



}
