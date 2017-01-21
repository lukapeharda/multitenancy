<?php

namespace LukaPeharda\MultiTenancy;

class Context
{
    /**
     * Tenant object instance
     * @var mixed
     */
    protected $tenant;

    /**
     * Init tenant object
     * @param mixed $tenant
     */
    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Return tenant object.
     * @return mixed
     */
    public function get()
    {
        return $this->tenant;
    }
}