<?php

namespace App\Models;

use App\Repositories\AssetPriceRepository;
use Exception;
use Illuminate\Support\Carbon;

class AccountMatchingRuleExt extends AccountMatchingRule
{
    public function getMatchValueAsOf($now, $isDatedReport, $func, $name): mixed
    {
        $value = 0;
        $mr = $this->matchingRule()->first();
        $account = $this->account()->first();
        if ($this->isInPeriod($now, $isDatedReport)) {
            if ($this->verbose) print_r($name . ": " . $mr->transactionMatchings()->count(). "\n");
            foreach ($mr->transactionMatchings()->get() as $tm) {
                foreach ($tm->$func()->get() as $transaction) {
                    $inTime = $this->isTransactionInTime($isDatedReport, $transaction->timestamp, $now);
                    if ($this->verbose) print_r("tran acct : " . $transaction->account_id . " " . $account->id . "\n");
                    if ($inTime && $transaction->account_id == $account->id) {
                        if ($this->verbose) print_r("vals: " . json_encode([$now, $transaction->toArray()]) . "\n");
                        $value += $transaction->value;
                    }
                }
            }
        }
        if ($this->verbose) print_r("{$name}: $value\n");
        return $value;
    }
    public function getMatchGrantedAsOf($now, $isDatedReport = true): mixed
    {
        return $this->getMatchValueAsOf($now, $isDatedReport, 'transaction', "getMatchGrantedAsOf");
    }
    public function getMatchConsideredAsOf($now, $isDatedReport = true): mixed
    {
        return $this->getMatchValueAsOf($now, $isDatedReport, 'referenceTransaction', "getMatchConsideredAsOf");
    }

    public function isTransactionInTime($isDatedReport, Carbon $timestamp, Carbon $now): bool
    {
        $inTime = !$isDatedReport || $now >= $timestamp;
        if ($this->verbose) print_r("now: " . $now . " ts " . $timestamp . " pastonly " . $isDatedReport . " inTime " . $inTime . "\n");
        return $inTime;
    }

    public function isInPeriod(Carbon $now, $isDatedReport=false) {
        $mr = $this->matchingRule()->first();
        $ret = $now >= $mr->date_start && $now <= $mr->date_end;
        if ($isDatedReport) {
            $ret = $now >= $mr->date_start;
        }
//        $this->verbose = true;
        if ($this->verbose) print_r("inPeriod: ".json_encode([
            $this->id, $this->matchingRule()->first()->id,
            "now", $now,
                "start", $mr->date_start,
                "end", $mr->date_end,
                $now >= $mr->date_start,
                $now <= $mr->date_end,
                "ret", $ret])
            . "\n");
        return $ret;
    }

    /**
     * @throws Exception
     */
    public function match(Transaction $tranToMatch) {
        // find unused amount
//        $this->verbose = false;
        if ($this->isInPeriod($tranToMatch->timestamp, false)) {
            $used = $this->getMatchConsideredAsOf($tranToMatch->timestamp, false);
            $mr = $this->matchingRule()->first();
            $possible = $mr->dollar_range_end - $mr->dollar_range_start;
            if ($used < $possible) {
                $account = $this->account()->first();
                // I could have used the "used" value, but when is first time we gotta calculate
                $deposits = $account->depositedValueBetween($mr->date_start, $mr->date_end);
                $applicable = $this->applicableValue($deposits, $tranToMatch->value);
                $matchValue = $applicable * ($mr->match_percent / 100.0);
                if ($this->verbose) print_r("match: " . json_encode([$used, $possible, $deposits, $applicable,
                            $tranToMatch->value, $tranToMatch->id, $matchValue]) . "\n");
                if ($applicable > $tranToMatch->value) {
                    throw new Exception("Matching more than the transaction value: tran id " + $tranToMatch->id);
                }
                return $matchValue;
            }
        }
        return 0;
    }

    private function applicableValue($base, $value) {
        $mr = $this->matchingRule()->first();
        return max(0, // non negative
            min($base + $value, $mr->dollar_range_end) // cap max
            - max($base, $mr->dollar_range_start)); // move base up
    }

}
