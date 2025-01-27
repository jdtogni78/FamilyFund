<?php

namespace App\Models;

use App\Http\Controllers\Traits\VerboseTrait;
use App\Repositories\ScheduledJobRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ScheduledJobExt extends ScheduledJob
{
    use VerboseTrait;

    const ENTITY_FUND_REPORT = 'fund_report';
    const ENTITY_TRANSACTION = 'transaction';

    public static $entityMap = [
        self::ENTITY_FUND_REPORT => 'Fund Report',
        self::ENTITY_TRANSACTION => 'Transaction',
    ];
    private static $fieldMap = [
        self::ENTITY_FUND_REPORT => 'as_of',
        self::ENTITY_TRANSACTION => 'timestamp',
    ];
    private static $classMap = [
        self::ENTITY_FUND_REPORT => FundReportExt::class,
        self::ENTITY_TRANSACTION => TransactionExt::class,
    ];

    public function shouldRunBy($today)
    {
        // find last run of report
        $lastReportDate = $this->lastGeneratedReportDate();

        /** @var ScheduleExt $schedule **/
        $schedule = $this->schedule()->first();
        $shouldRunBy = $schedule->shouldRunBy($today, $lastReportDate);

        $this->debug('shouldRunBy', [
            'today' => $today->toDateString(),
            'lastRun' => $lastReportDate?->toDateString(),
            'shouldRunBy' => $shouldRunBy->toDateString(),
        ]);
        return [
            'today' => $today,
            'lastRun' => $lastReportDate,
            'shouldRunBy' => $shouldRunBy,
        ];
    }

    public function lastGeneratedReportDate() : ?Carbon
    {
        // find last run of report
        $field = self::$fieldMap[$this->entity_descr];
//        Log::debug("trans " . json_encode(TransactionExt::all()->toArray()));
        $query = self::$classMap[$this->entity_descr]::query();
        $ret = $query
            ->where('scheduled_job_id', $this->id)
            ->orderBy($field, 'desc')
            ->first();
        $this->info("lastGeneratedReport $this->id " . json_encode($ret));
        $lastRun = $ret != null? Carbon::parse($ret->$field) : null;
        return $lastRun;
    }

    // get scheduled jobs that relate to this transaction
    public static function scheduledJobs($type, $id)
    {
        $scheduledJobRepo = \App::make(ScheduledJobRepository::class);
        $sjs = $scheduledJobRepo->makeModel()->newQuery()
            ->where('entity_descr', $type)
            ->where('entity_id', $id)
            ->get();
        Log::debug("Scheduled jobs $type $id: " . json_encode($sjs));
        return $sjs;
    }

    public function entities()
    {
        return self::$classMap[$this->entity_descr]::where('scheduled_job_id', $this->id)->get();
    }

}
