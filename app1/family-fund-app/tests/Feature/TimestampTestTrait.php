<?php

namespace Tests\Feature;

use Nette\Utils\DateTime;

trait TimestampTestTrait
{
    protected DateTime $date;

    public function setupTimestampTest($date = '2022-01-01') {
        $this->date = new DateTime($date);
        return $this->timestamp();
    }

    protected function updateTimestamp()
    {
        $this->post["timestamp"] = $this->timestamp();
    }

    public function timestamp(): string
    {
        return $this->date() . "T00:00:00";
    }
    public function date(): string
    {
        return $this->date->format('Y-m-d');
    }

    public function nextDay(int $days)
    {
        $this->date->modify('+'.$days.' day');
        $this->updateTimestamp();
        return $this->timestamp();
    }

    public function nextMonth(int $months=1)
    {
        $this->date->modify('+'.$months.' month');
        $this->updateTimestamp();
        return $this->timestamp();
    }

    public function prevDay()
    {
        $this->date->modify('-1 day');
        $this->updateTimestamp();
        return $this->timestamp();
    }


    protected function compareTimestamp(mixed $timestamp, mixed $timestamp1)
    {
        return substr($timestamp, 0, 10) == substr($timestamp1, 0, 10);
    }

    protected function isInfinity(mixed $timestamp)
    {
        return $this->compareTimestamp($timestamp, "9999-12-31");
    }

    protected function assertInfinity(mixed $timestamp)
    {
        $this->assertTrue($this->isInfinity($timestamp));
    }

    protected function assertDate(mixed $expected, mixed $actual)
    {
        $this->assertEquals(substr($expected, 0, 10), substr($actual, 0, 10));
    }

}
