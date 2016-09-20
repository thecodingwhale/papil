<?php

namespace App;

Class Calculator {

    protected $result = 0;

    public function sum($argument1, $argument2)
    {
        $this->result = (int)$argument1 + (int)$argument2;
    }

    public function result()
    {
        return $this->result;
    }
}