<?php

namespace App\Listeners;

use App\Events\studentonline;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class studentonlineListener
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
     * @param  studentonline  $event
     * @return void
     */
    public function handle(studentonline $event)
    {
        //
    }
}
