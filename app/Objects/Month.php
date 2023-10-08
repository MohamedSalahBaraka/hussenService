<?php

namespace App\Objects;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Month
{
    public $days;
    public $month;
    public $startDay;
    public $year;
    public function __construct(Collection $books, int $month, int $year)
    {
        $this->month = $month;
        $this->year = $year;

        $date = Carbon::createFromFormat('Y-m-d', $year . '-' . $month . '-1');

        $this->startDay = $date->dayOfWeek;

        $daysInMonth = Carbon::now()->month($month)->daysInMonth;
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $this->days[$i] = new Day($i);
        }
        foreach ($books as $book) {
            $this->days[$book->day]->Book();
        }
    }
}
