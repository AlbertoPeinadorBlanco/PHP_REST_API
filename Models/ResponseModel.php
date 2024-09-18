<?php

namespace Models;
use DOMDocument;

//Class to handle the responses from the server to the user
class ResponseModel 
{
    private $code;

    private $cacheable;

    private $message;

    private $data;

    private $responseBody;

    public function __construct($code, $cacheable, $message = NULL, $data = NULL)
    {

        $this->code = $code;
        $this->cacheable = $cacheable;

        http_response_code($code);

        switch($code)
        {

            case 200:
                $this->message = "OK";
                break;
            case 201:
                $this->message = "OK. Resource Created";
                break;
            case 204:
                $this->message = "OK. No Content";
                break;
            case 400:
                $this->message = "Error: Bad Request" . $message;
                break;
            case 401:
                $this->message = "Error: Authentication Required . $message";
                break;
            case 403:
                $this->message = "Error: Forbidden Resource";
                break;
            case 404:
                $this->message = "Error: Resource Not Found";
                break;
            case 405:
                $this->message = "Error: Request Not Supported" . $message;
                break;
            case 409;
                $this->message = "Error: Conflict of Files" . $message;
                break;
            case 500:
                $this->message = "Error: Internal Server Error" . $message;
                break;

        }
        
        if($data !== NULL)
        {

            $this->data = $data;

        }


    }

    //Function to create the structure of the response and select the format
    public function send($format) 
    {

        if($this -> cacheable === true)
        {

            header('Cache-Control: max-age-60');

        } 
        else 
        {

            header('Cache-Control: no-store');

        }

        $this->responseBody['Status'] = $this->code;
        $this->responseBody['Message'] = $this->message;


        if($this -> data !== NULL)
        {

            $this->responseBody['Data'] = $this->data;

        }
        

        if($format === 'json')
        {

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($this->responseBody);
            exit();

        }
        if($format === 'xml')
        {

            header('content-type: application/xml');
            $dom = new DOMDocument('1.0', 'utf-8');
            $dom -> preserveWhiteSpace = false;
            $dom -> formatOutput = true;
            $root = $dom -> createElement("response");
            $dom -> appendChild($root);

            $this -> createXML($this -> responseBody, $root, $dom);
            echo $dom -> saveXML();

            exit();

        }
       
        
    }

    //Function to create XML responses
    public function createXML($array, $node, &$dom)
    {

        foreach($array as $key => $value)
        {

            if (preg_match("/^[0-9]/", $key))
            {

                $key = "node-{$key}";

            }


            $key = preg_replace("/^a-z0-9_\-]+/i", '', $key);


            if($key === '')
            {

                $key = '_';

            }


            $element = $dom -> createElement($key);
            $node -> appendChild($element);


            if(!is_array($value))
            {

                $element -> appendChild($dom -> createTextNode($value));

            }
            else
            {

                $this -> createXML($value, $element, $dom);

            }

        }

    }

}