<?php

namespace LukaPeharda\MultiTenancy\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TenantScope implements Scope
{
    /** Apply the tenant scope to Eloquent Model.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        return $builder->where($model->getTable() . '.' . config('multitenancy.tenant.key'), context('id'));
    }
}