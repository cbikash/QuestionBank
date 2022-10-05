<?php


namespace Vxsoft\Main\Constant;


class Constant
{

    const DURATION_TYPE_YEAR = 'year';
    const DURATION_TYPE_MONTH = 'month';
    const DURATION_TYPE_WEEK = 'week';
    const DURATION_TYPE_DAY = 'day';

    static $durationTypes = [
        self::DURATION_TYPE_YEAR => 'Year',
        self::DURATION_TYPE_MONTH => 'Month',
        self::DURATION_TYPE_WEEK => 'Week',
        self::DURATION_TYPE_DAY => 'Day',
    ];

}