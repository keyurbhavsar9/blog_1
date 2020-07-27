<?php

namespace App\Console\Commands;

use App\Company;
use Illuminate\Console\Command;

class AddCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a company into database';

    public function handle()
    {
        $name = $this->ask('Name of comapny');
        $phone = $this->ask('Contact number of comapny');

        $this->info($name);
        $this->info($phone);

        if ($this->confirm('Ready to insert company' . $name . '?')) {
            $company  = Company::create([
                'name' => $name,
                'phone' => $phone,
            ]);
            $this->info('Added ' . $company->name);
        } else {
            $this->warn('No new comnpany added');
        }


        //$this->info('Added ' . $company->name);
    }
}
