<?php

namespace App\Listeners;

use App\Mail\WelcomeNewUserMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeCustomerListner implements ShouldQueue
{
    public function handle($event)
    {
        sleep(10);

        Mail::to($event->customer->email)->send(new WelcomeNewUserMail());
    }
}
