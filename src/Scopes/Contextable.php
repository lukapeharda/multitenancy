<?php

namespace LukaPeharda\MultiTenancy\Scopes;

trait Contextable
{
    /**
     * Model booting method. Attach tenant scope as global.
     * @return void
     */
    public static function bootContextable()
    {
        static::addGlobalScope(new TenantScope);
    }
}