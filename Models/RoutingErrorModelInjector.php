<?php

namespace Models;

//Class used to invert dependencies
class RoutingErrorModelInjector
{

    private $i_routing;


    function __construct(IRoutingErrorsModel $routing_error)
    {

        $this -> i_routing = $routing_error;

    }

    public function errorRouting()
    {

        $this -> i_routing -> routingError();

    }

}