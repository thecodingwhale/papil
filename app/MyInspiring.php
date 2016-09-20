<?php

namespace App;

use Illuminate\Foundation\Inspiring;

class MyInspiring extends Inspiring
{
    public function quoteBackwards()
    {
        return strrev(parent::quote());
    }
}