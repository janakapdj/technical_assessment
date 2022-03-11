<?php
class Homepage extends Controller {
    public function __construct() {
      
    }

    public function index() {
        $data = [
            'title' => 'Campaigns Homepagepaign'
        ];

        $this->view('index', $data);
    }

}