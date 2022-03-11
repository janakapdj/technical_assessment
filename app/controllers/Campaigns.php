<?php
class Campaigns extends Controller {
    public function __construct() {
        $this->CampaignModel = $this->model('Campaign');
    }

    public function index() {
        $data = [
            'title' => 'Campaigns Homepagepaign'
        ];

        $this->view('campaigns/index', $data);
    }

    public function report() {

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'campaign_type' => trim($_POST['campaign_type']),
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
            ];
            if(!empty($_POST['campaign_type']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
                $campaigns =  $this->CampaignModel->getFilteredCampaigns($data);
            }else {
                $campaigns =  $this->CampaignModel->getFilteredCampaignsByType($data);
            }
            $campaign_type = $_POST['campaign_type'];
        }else {
            $campaigns =  $this->CampaignModel->getCampaigns();
            $campaign_type = "All";
        }
        
        $data = [
            'title' => 'Campaign Reports',
            'campaigns' => $campaigns,
            'campaign_type' => $campaign_type,
        ];

        $this->view('campaigns/campaigns', $data);
    }

}