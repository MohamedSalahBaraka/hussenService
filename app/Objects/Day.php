<?php

namespace App\Objects;


class Day
{
    private $hasBook;
    public $day;
    public function __construct(int $day)
    {
        $this->hasBook = false;
        $this->day = $day;
    }
    public function Book()
    {
        $this->hasBook = true;
    }
    public function isBooked()
    {
        return $this->hasBook;
    }
}
