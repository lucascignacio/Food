<?php

namespace App\Tenant\Traits;

use App\Tenant\Observers\TenantObserver;

trait TenantTrait
{

    /**
     * The "booting" method od the model. 
     */

    protected static function booted(): void
    {
        static::observe(TenantObserver::class);
    }
}