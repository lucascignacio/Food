<?php

namespace App\Tenant\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    /**
     * Handle the Model "creating" event.
     */
    public function creating(Model $model): void
    {
        $managerTenant = app(ManagerTenant::class);
        
        $identify = $managerTenant->getTenantIdentify();

        if($identify)
            $model->tenant_id = $identify;
    }
}