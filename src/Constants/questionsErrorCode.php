<?php

namespace App\Constants;

class questionsErrorCode
{
    const TAGGED_NOT_FOUND     ="EC01";
    const TODATE_FORMAT        ="EC02";
    const FROMDATE_FORMAT      ="EC03";

    public static function getTypes(){
        return [
            'TAGGED_NOT_FOUND' => [
                'constant' => self::TAGGED_NOT_FOUND,
                'description'     => self::toString(self::TAGGED_NOT_FOUND),
            ],
            'TODATE_FORMAT' => [
                'constant' => self::TODATE_FORMAT,
                'description'     => self::toString(self::TODATE_FORMAT),
            ],
            'FROMDATE_FORMAT' => [
                'constant' => self::FROMDATE_FORMAT,
                'description'     => self::toString(self::FROMDATE_FORMAT),
            ]
        ];
    }

    public static function toString($id){
        switch ($id){
            case self::TAGGED_NOT_FOUND:   return 'Parameters Tagged is require';
            case self::TODATE_FORMAT:      return 'Parameters Todate not present *Date* format [Y-m-d]';
            case self::FROMDATE_FORMAT:    return 'Parameters Fromdate not present *Date* format [Y-m-d]';
        }
    }
}