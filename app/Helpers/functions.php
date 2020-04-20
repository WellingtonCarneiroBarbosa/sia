<?php

    /***
     * calculates the percentage change if
     * there is profit (positive change)
     * 
     * percentage change = (bigger - smaller) * 100 / smaller
     *
     * Return @float_number
     */
    function positivePercentageChange($bigger, $smaller){
        $percentageChange      = $bigger - $smaller; 
        $percentageChange      = $percentageChange * 100;
        $percentageChange      = $percentageChange / $smaller;
        $percentageChange      = number_format($percentageChange, 0, '.', '');
        return $percentageChange;
    }

    /***
     * calculates the percentage change if
     * there is loss (negative change)
     * 
     * percentage change = (bigger - smaller) * 100 / bigger
     *
     * Return @float_number
     */
    function negativePercentageChange($bigger, $smaller){
        $percentageChange      = $bigger - $smaller; 
        $percentageChange      = $percentageChange * 100;
        $percentageChange      = $percentageChange / $bigger;
        $percentageChange      = number_format($percentageChange, 0, '.', '');
        return $percentageChange;
    }

    /***
     * return a number as percentage form
     * 
     * percentage_form = (number) * 100;
     *
     * Return @float_number
     */
    function percentageForm($number){
        $percentageForm = $number * 100;
        $percentageForm = number_format($percentageForm, 0, '.', '');
        return $percentageForm;
    }

    /***
     * Convert any american date to
     * brazilian format
     * 
     * return @date
     */
    function dateBrazilianFormat($value, $format='d/m/Y')
    {
        return date($format, strtotime($value));
    }

    /***
     * Convert any american time to
     * brazilian format
     * 
     * return @date
     */
    function timeBrazilianFormat($value, $format='G:i')
    {
        return date($format, strtotime($value));
    }

    /***
     * Convert any american datetime to
     * brazilian format
     * 
     * return @date
     */
    function dateTimeBrazilianFormat($value, $format='d/m/Y H:i')
    {
        return date($format, strtotime($value));
    }

    /***
     * Convert any brazilian datetime to
     * server format
     * 
     * return @date
     */
    function dateTimeServerFormat($value, $format='Y/d/m H:i')
    {
        return date($format, strtotime($value));
    }

    /***
     * performs the interval calculation
     * between two dates
     * 
     * return @date
     */
    function dateRange($dateStart, $dateEnd){
            $dateStart 		= $dateStart;
            $dateStart 		= implode('-', array_reverse(explode('/', substr($dateStart, 0, 10)))).substr($dateStart, 10);
            $dateStart 		= new DateTime($dateStart);
            $dateEnd 		= $dateEnd;
            $dateEnd 		= implode('-', array_reverse(explode('/', substr($dateEnd, 0, 10)))).substr($dateEnd, 10);
            $dateEnd 		= new DateTime($dateEnd);

            $dateRange = array();

            while($dateStart <= $dateEnd){
                $dateRange[]  = $dateStart->format('Y-m-d');
                $dateStart    = $dateStart->modify('+1day');
            }

            return $dateRange;
    }

    /***
     * performs the interval calculation
     * between two times
     * 
     * return @date
     */
    function timeRange($timeStart, $timeEnd){
        $timeStart      = $timeStart;
        $timeStart 		= implode('-', array_reverse(explode('/', substr($timeStart, 0, 10)))).substr($timeStart, 10);
        $timeStart      = new DateTime($timeStart);

        $timeEnd        = $timeEnd;
        $timeEnd 		= implode('-', array_reverse(explode('/', substr($timeEnd, 0, 10)))).substr($timeEnd, 10);
        $timeEnd        = new DateTime($timeEnd);

        $timeRange = array();
        while($timeStart <= $timeEnd){
            $timeRange[]  = $timeStart->format('G:i');
            $timeStart    = $timeStart->modify('+1minute');
        }

        return $timeRange;
    }

    /***
     * Split a datetime
     * 
     * return @array
     */
    function dateTimeExplode($dateTime){
        $splitTimeStamp = explode(" ", $dateTime);
        return $splitTimeStamp;
    }

    /***
     * Convert any brazilian date to
     * american format
     * 
     * return @date
     */
    function dateAmericanFormat($date){
        $date = implode('-', array_reverse(explode('/', substr($date, 0, 10)))).substr($date, 10);
        return $date;
    }

    /***
     * Clean any cpf or cnpj 
     * 
     * return @string
     */
    function clearCPForCNPJ($string){
        $string = trim($string);
        $string = str_replace(".", "", $string);
        $string = str_replace(",", "", $string);
        $string = str_replace("-", "", $string);
        $string = str_replace("/", "", $string);
        return $string;
    }

    /***
     * Clean any cep 
     * 
     * return @string
     */
    function clearCEP($string){
        $string = trim($string);
        $string = str_replace("-", "", $string);
        return $string;
    }

    /***
     * Clean any phone number
     * 
     * return @string
     */
    function clearPhoneNumber($string){
        $string = trim($string);
        $string = str_replace("(", "", $string);
        $string = str_replace(")", "", $string);
        $string = str_replace(" ", "", $string);
        $string = str_replace("-", "", $string);
        return $string;
    }

    /***
     * Adds cpf score 
     * 
     * return @string
     */
    function CPFscore($string){
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $string);
    }

    /***
     * Adds cep score 
     * 
     * return @string
     */
    function CEPscore($string){
        return preg_replace("/(\d{5})/", "\$1-\$2", $string);
    }

    /***
     * Adds phone number score 
     * 
     * return @string
     */
    function phoneNumberScore($string){
        if(strlen($string) == 10){
            $newString = substr_replace($string, '(', 0, 0);
            $newString = substr_replace($newString, ' ', 3, 0);
            $newString = substr_replace($newString, ')', 3, 0);

            $newString = substr_replace($newString, '-', 9, 0);
            return $newString;
        }
    }

    /***
     * Verify if has data at
     * any collection
     * 
     * return @boolean
     */
    function hasData($collection){
        $count = count($collection);
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }

    /***
     * Validade dates
     * 
     */
    function isDate01BiggerThanDate02($date01, $date02){
        $date01 = strtotime($date01);
        $date02 = strtotime($date02);

        if($date01 > $date02){
            return true;
        }

        return false;
    }

    function isDate01EqualsDate02($date01, $date02){
        $date01 = strtotime($date01);
        $date02 = strtotime($date02);

        if($date01 === $date02){
            return true;
        }

        return false;
    }