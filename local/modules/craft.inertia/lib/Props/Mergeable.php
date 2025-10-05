<?php

namespace Craft\Inertia\Props;

interface Mergeable
{
    public function merge();

    public function shouldMerge();
}
