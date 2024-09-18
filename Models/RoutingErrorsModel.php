<?php

namespace Models;

//Class to handle the errors related to the routing functions
class RoutingErrorsModel implements IRoutingErrorsModel
{

    //Function to handle the errors related to the routing functions
    public function routingError()
    {
        
        $output_function = new FormatSelectionModel();
        $output_injector = new FormatSelectionModelInjector($output_function);

        $output = $output_injector -> formatChose();

        $response = new ResponseModel(404, true, null, null);
        $response -> send($output);
        exit();

    }

}