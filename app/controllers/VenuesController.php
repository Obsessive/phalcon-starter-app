<?php

namespace app\controllers;

use app\models\Venue;

class VenuesController extends ControllerBase
{

    public function indexAction()
    {
        $config = $this->di->get('config');
    }

    /**
     * Used in AJAX request
     */
    public function venuesJsonAction()
    {
        $venues = Venue::find();

        return $this->response->setJsonContent($venues->toArray());
    }

    /**
     * Used in AJAX request
     */
    public function venueDetailsJsonAction()
    {
        if ($this->request->isPost()) {

            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
        
            $placeId = $request->place_id;

            $placeDetails = file_get_contents("https://maps.googleapis.com/maps/api/place/details/json?placeid=" . $placeId . "&key=" . $this->config->google->api_key);

            echo $placeDetails;
        }
    }
}

