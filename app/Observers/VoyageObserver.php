<?php

namespace App\Observers;

use App\Models\Voyage;

class VoyageObserver
{
    /**
     * Handle the Voyage "created" event.
     */
    public function created(Voyage $voyage): void
    {
        //
    }

    /**
     * Handle the Voyage "updated" event.
     */
    public function updated(Voyage $voyage): void
    {
        //
    }

    /**
     * Handle the Voyage "deleted" event.
     */
    public function deleted(Voyage $voyage): void
    {
        // les tickets du voyage principale
        $voyage->tickets()->update(["statut", "annulé"]);

        // les tickets des sous voyages
        $voyage->sousVoyages()->each(function ($sousVoyage) {
            $sousVoyage->tickets()->update(["statut", "annulé"]);
        });
    }

    /**
     * Handle the Voyage "restored" event.
     */
    public function restored(Voyage $voyage): void
    {
        //
    }

    /**
     * Handle the Voyage "force deleted" event.
     */
    public function forceDeleted(Voyage $voyage): void
    {
        //
    }
}
