<?php
namespace plugin\tools;

class WorkDate {

    //法定节假日，平时的周六日不算
    public static $holidays = [
        '20200124',
        '20200125',
        '20200126',
        '20200127',
        '20200128',
        '20200129',
        '20200130',
    ];

    /*
     * 所有的调休日期，比如国庆假期前后周六、周日需要调休上班
     * 责需要把这些日期放入 $daysOff 数组中格式
     *
     * $daysOff = [
     *      '20200927',
     *      '20201010',
     * ];
     */
    public static $daysOff = [
        '20200119',
        '20200201',
    ];

    /**
     * 判断给定的日期是不是工作日
     *
     * @param string $curDay  给定的日期
     * @return boolean
     */
    public static function isWorkDay($curDay = ''){
        $curDayTime = strtotime($curDay);
        if($curDayTime === false){
            $curDayTime = time();
        }
        $curDay = date('Ymd',$curDayTime);

        //节假日不是工作日
        if(in_array($curDay,self::$holidays)){
            return false;
        }

        //调休日期是工作日
        if(in_array($curDay,self::$daysOff)){
            return true;
        }

        //周六日不是工作日
        $weekday = date('N',$curDayTime);
        if($weekday == 6 || $weekday == 7){
            return false;
        }

        return true;
    }

}
