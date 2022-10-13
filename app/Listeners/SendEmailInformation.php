<?php
 
namespace App\Listeners;
 
use App\Events\CreateUser;
use App\Jobs\SendEmail;

class SendEmailInformation
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
 
    /**
     * Handle the event.
     *
     * @param  CreateUser  $event
     * @return void
     */
    public function handle(CreateUser $event)
    {
        dispatch(new SendEmail(['email' => $event->user->email]));
    }
}