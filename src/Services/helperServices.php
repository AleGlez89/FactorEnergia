<?php

namespace App\Services;

class helperServices
{
    public function prepareParameterByQuery($fromdate,$todate,$tagged){
        $response = [
            'order' => 'desc',
            'sort' => 'activity',
            'tagged' => $tagged,
            'site' => 'stackoverflow'
        ];

        if(isset($fromdate) && !empty($fromdate)){
          $response['fromdate'] = $this->convertDateToTimeUnix($fromdate);
        }
        if(isset($todate) && !empty($todate)){
            $response['todate'] = $this->convertDateToTimeUnix($todate);
        }
        return $response;
    }
    
    public function convertDateToTimeUnix($date){
        $unixTimeDate = strtotime($date);
        return $unixTimeDate;
    }
}