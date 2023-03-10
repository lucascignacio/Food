<?php

namespace App\Tenant\Scopes;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a give Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $identify = app(ManagerTenant::class)->getTenantIdentify();

        if($identify)
            $builder->where('tenant_id', $identify);
    }
}