<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectCreated as ProjectCreatedMail;
use App\Events\ProjectCreatedEvent;
// use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendProjectCreatedNotification
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
     * @param  ProjectCreatedEvent  $event
     * @return void
     */
    public function handle(ProjectCreatedEvent $event)
    {
        // this will be executed only after a project has been created and inserted into DB
        \Mail::to($event->project->owner->email/*'someAdresse@mail.com'*/)->send(
            new ProjectCreatedMail($event->project) // creating a Mailable instance
        );
    }
}
