<?php

namespace Craft\Inertia\Props;

class AlwaysProp
{
    /** @var mixed */
    protected $value;

    /**
     * @param  mixed  $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __invoke()
    {
        return value($this->value);
    }
}
