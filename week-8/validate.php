<?php
    class validate{
        public function checkEmpty($data, $fields){
            $msg = null;
            foreach($fields as $value){
                if(empty($data[$value])){
                    $msg .= "<p>$value field empty</p>";
                }
            }
            return $msg;
        }
        /*
            Check to see if the provide age contains only numbers. Using preg_match().
        */
        public function validAge($age){
            /*
                preg_match() uses regular expressions to look for text patterns in a string. Such as ("/^[0-9]+$/").
                ^ - start at the beginning of the text.
                [0-9] - must match one or more digits
                $ - must end right after one of those digits.
            */
            if(preg_match('/^[0-9]+$/', $age)){
                return true;
            }else{
                return false;
            }
        }
        public function validEmail($email){
            /*
                filter_var() is a built-in PHP function used to sanitize or validate data. FILTER_VALIDATE_EMAIL is a built-in PHP constant (a type of global flag).
            */
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                return true;
            }else{
                return false;
            }
        }
    }
?>