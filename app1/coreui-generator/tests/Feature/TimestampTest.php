<?php

namespace Tests\Feature;

use Nette\Utils\DateTime;

trait TimestampTest
{
    protected $date;

    public function setupTimestampTest() {
        $this->date = new DateTime("2022-01-01");
    }

    protected function updateTimestamp()
    {
        $this->post["timestamp"] = $this->timestamp();
    }

    public function timestamp(): string
    {
        return $this->date->format('Y-m-d') . "T00:00:00";
    }

    public function nextDay(int $days)
    {
        $this->date->modify('+'.$days.' day');
        $this->updateTimestamp();
    }

    public function prevDay()
    {
        $this->date->modify('-1 day');
        $this->updateTimestamp();
    }


    protected function compareTimestamp(mixed $timestamp, mixed $timestamp1)
    {
        return substr($timestamp, 0, 10) == substr($timestamp1, 0, 10);
    }

    protected function isInfinity(mixed $end_dt)
    {
        return $this->compareTimestamp($end_dt, "9999-12-31");
    }

    protected function assertDate(mixed $expected, mixed $actual)
    {
        $this->assertEquals(substr($expected, 0, 10), substr($actual, 0, 10));
    }

}
