<?php

namespace Models;

//Class to select Json or XML as a response format
class FormatSelectionModel implements IFormatSelectionModel
{

    public function choseFormat()
    {

        if($_SERVER['HTTP_ACCEPT'] == 'application/json')
        {

            $output = 'json';
            return $output;            

        }
        if($_SERVER['HTTP_ACCEPT'] == 'application/xml')
        {

            $output = 'xml';
            return $output;

        }
        else
        {

            $output = 'json';
            return $output;  

        }

        

    }

}