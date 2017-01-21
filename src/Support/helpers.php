<?php

/**
 * Access tenant through context.
 *
 * @param  string  $attribute
 * @return mixed
 */
function context($attribute = null)
{
    if (is_null($attribute)) {
        return app('context')->get();
    }

    return app('context')->get()->$attribute;
}