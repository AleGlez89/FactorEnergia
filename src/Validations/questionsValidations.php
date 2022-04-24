<?php

namespace App\Validations;

use App\Constants\questionsErrorCode;
use DateTime;

class questionsValidations
{
    public function checkParameters($parameters){
        $errorCode = null;
        $validate = true;
        $errors= [];
        $data = [
            'Todate' => null,
            'Fromdate' => null,
            'Tagged' => null,
        ];

        if(isset($parameters['Tagged']) && !empty($parameters['Tagged'])){
            $data['Tagged'] = $parameters['Tagged'];
            if(isset($parameters['Todate']) && !empty($parameters['Todate'])){
                if(!$this->validateDate($parameters['Todate'])){
                    $errorCode = questionsErrorCode::TODATE_FORMAT;
                    $errors['Todate'] = questionsErrorCode::getTypes($errorCode)['TODATE_FORMAT']['description'];
                    $validate = false;
                } else {
                    $data['Todate'] = $parameters['Todate'];
                }
            }
            if(isset($parameters['Fromdate']) && !empty($parameters['Fromdate'])){
                if(!$this->validateDate($parameters['Fromdate'])){
                    $errorCode = questionsErrorCode::FROMDATE_FORMAT;
                    $errors['Fromdate'] = questionsErrorCode::getTypes($errorCode)['FROMDATE_FORMAT']['description'];
                    $validate = false;
                } else {
                    $data['Fromdate'] = $parameters['Fromdate'];
                }
            }
        } else {
            $errorCode = questionsErrorCode::TAGGED_NOT_FOUND;
            $errors['Tagged'] = questionsErrorCode::getTypes($errorCode)['TAGGED_NOT_FOUND']['description'];
            $validate = false;
        }
        return array(
            'validate' => $validate,
            'data'     => $data,
            'errors'   => $errors
        );
    }

    private function validateDate($date){
        $format = 'Y-m-d';
        $check = DateTime::createFromFormat($format,$date);
        return $check && $check->format($format) === $date;
    }
}