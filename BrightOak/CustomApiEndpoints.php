<?php

namespace App\BrightOak;


class CustomApiEndpoints
{

    /**
     * This must be included in app/setup.php
     */
    public static function init()
    {
        add_action('rest_api_init', function(){
            $self = new self;

            register_rest_route( 'brightoak/v1', '/contact/submit/', [
                'methods' => 'POST',
                'callback' => [$self,'submitContact'],
            ] );
            // Add additional calls to register_rest_route here to register multpile methods.

        });
    }

    /**
     * @param \WP_REST_Request $request
     * A public method should be created for each unique endpoint to handle the data
     * If data is returned, it should be in JSON format.
     */
    public function exampleEndpoint(\WP_REST_Request $request)
    {
        // handle your contact form here
        // make your ajax call to /brightoak/v1/contact/submit
        // get your POST data from $request->get_param('param_name')
    }

}