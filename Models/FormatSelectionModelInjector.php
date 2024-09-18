<?php

namespace Models;

//Class for inverting dependencies
class FormatSelectionModelInjector
{

    private $i_format;


    function __construct(IFormatSelectionModel $format)
    {

        $this -> i_format = $format;

    }

    public function formatChose()
    {

        return $this -> i_format -> choseFormat();

    }

}