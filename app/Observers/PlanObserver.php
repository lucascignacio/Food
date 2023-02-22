<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Plan;

class PlanObserver
{
    /**
     * Handle the Plan "creating" event.
     */
    public function creating(Plan $plan)
    {
        $plan->url = Str::kebab($plan->name);
    }

    /**
     * Handle the Plan "updating" event.
     */
    public function updating(Plan $plan)
    {
        $plan->url = Str::kebab($plan->name);
    }
}
