<?php

namespace App\Observers;

use App\Models\Places\Place;

class PlaceObserver
{
    /**
     * Handle the place "created" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function created(Place $place)
    {
        //
    }

    /**
     * Handle the place "updated" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function updated(Place $place)
    {
        //
    }

    /**
     * Handle the place "deleted" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function deleted(Place $place)
    {
        //
    }

    /**
     * Handle the place "restored" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function restored(Place $place)
    {
        //
    }

    /**
     * Handle the place "force deleted" event.
     *
     * @param  \App\Models\Places\Place  $place
     * @return void
     */
    public function forceDeleted(Place $place)
    {
        //
    }
}
