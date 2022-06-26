<?php

    if (!function_exists('_settings')) {
        function _settings($key = '') {
            if($key == '')
                return NULL;

            $data = DB::table('settings')->select('value')->where(['key' => $key])->first();

            if(!empty($data))
                return $data->value;
            else
                return NULL;
        }
    }

    if (!function_exists('_check')) {
        function _check($number){
            if($number == 0)
                return 1;
            else if($number == 1)
                return 0;
            else if($number<0)
                return _check(-$number);
            else
                return _check($number-2);        
        }
    }

?>