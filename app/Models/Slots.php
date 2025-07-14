<?php

namespace App\Models;

class Slots
{
    public \DateTimeImmutable $date {
        get {
            return $this->date;
        }
        set(\DateTimeImmutable $value) {
            $this->date = $value;
        }
    }

    public string $dateFormatted {
        get {
            return $this->date->format('Y-m-d');
        }
    }

    public $service_id {
        get {
            return $this->service->id;
        }
    }

    public Service $service {
        get {
            return $this->service;
        }
        set {
            $this->service = $value;
        }
    }

    public array $slots {
        get {
            return $this->FreeSlots();
        }
    }

    public function __construct(Service $service, \DateTimeImmutable $givendate)
    {
        $this->service = $service;
        $this->date = $givendate;
    }

    public function FreeSlots(): array
    {

        $service = $service ?? $this->service;
        $givendate = $givendate ?? $this->date;

        $intervalMinuteInteger = 30;
        $interval = \DateInterval::createFromDateString(str($intervalMinuteInteger).' minutes');
        $dateFormatted = $givendate->format('Y-m-d');
        $timeToAlot = $service->timerange;

        $workingTimeRanges = WorkingTime::where('weekday', $givendate->format('N'))
            ->orderBy('starttime')
            ->get()
            ->map(function ($v) use ($dateFormatted) {
                return [
                    'starttime' => new \DateTime($dateFormatted.$v->starttime),
                    'endtime' => new \DateTime($dateFormatted.$v->endtime),
                ];
            });

        $Bookings = Booking::where('s_date', $dateFormatted)->get()->map(function ($booking) {
            $result = [];
            $result['starttime'] = new \DateTimeImmutable($booking['s_date'].' '.$booking['s_time']);
            $result['endtime'] = $result['starttime']->add(
                \DateInterval::createFromDateString(round(Service::find($booking->user_id)->timerange / 60).' minutes')
            );

            return $result;
        });

        $checkTime = (new \DateTimeImmutable($dateFormatted.' 00:00:00'))
            ->setTime(
                $workingTimeRanges[0]['starttime']->format('H'),
                intval($workingTimeRanges[0]['starttime']->format('i'))
                    - intval($workingTimeRanges[0]['starttime']->format('i')) % $intervalMinuteInteger,
                0,
            );

        $FreeSlots = [];
        for ($i = 0; $i < (15 * 60 / $intervalMinuteInteger); $i++) {
            if (
                self::isInsideRanges($checkTime, $timeToAlot, $workingTimeRanges)
                && self::isOutsideRanges($checkTime, $timeToAlot, $Bookings)
            ) {
                $FreeSlots[] = $checkTime->format('Y-m-d H:i:s');
            }

            $checkTime = $checkTime->add($interval);
        }

        return $FreeSlots;
    }

    private static function isInsideRanges($startTime, $timeToAlot, $Ranges): bool
    {
        foreach ($Ranges as $Range) {
            if (self::isInsideRange($startTime, $timeToAlot, $Range)) {
                return true;
            }
        }

        return false;
    }

    private static function isInsideRange($startTime, $timeToAlot, $Range): bool
    {
        $endTime = new \DateTime($startTime->add(
            \DateInterval::createFromDateString(round($timeToAlot / 60).' minutes')
        )->format(\DateTime::COOKIE));

        return $Range['starttime'] <= $startTime && $endTime <= $Range['endtime'];
    }

    private static function isOutsideRanges($startTime, $timeToAlot, $Ranges): bool
    {
        foreach ($Ranges as $Range) {
            if (! self::isOutsideRange($startTime, $timeToAlot, $Range)) {
                return false;
            }
        }

        return true;
    }

    private static function isOutsideRange($startTime, $timeToAlot, $Range): bool
    {
        $endTime = new \DateTime($startTime->add(
            \DateInterval::createFromDateString(round($timeToAlot / 60).' minutes')
        )->format(\DateTime::COOKIE));

        return $endTime <= $Range['starttime'] || $Range['endtime'] <= $startTime;
    }
}
