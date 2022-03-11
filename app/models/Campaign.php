<?php
    class Campaign {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getCampaigns() {
            $this->db->query("SELECT campaigns.id, campaigns.campaign_name, 
            (SELECT SUM(orders.order_value) FROM orders WHERE orders.campaign_id = campaigns.id) AS total_revenue
            FROM campaigns
            ORDER BY campaigns.id");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getFilteredCampaigns($data) {
            $this->db->query("SELECT campaigns.id, campaigns.campaign_name, 
            (SELECT SUM(orders.order_value) FROM orders WHERE orders.campaign_id = campaigns.id) AS total_revenue
            FROM campaigns
            WHERE campaigns.start_date >= :start_date AND campaigns.end_date <= :end_date AND campaigns.campaign_type = :campaign_type
            ORDER BY campaigns.id");

            //Bind values
            $this->db->bind(':start_date', $data['start_date']);
            $this->db->bind(':end_date', $data['end_date']);
            $this->db->bind(':campaign_type', $data['campaign_type']);

            $result = $this->db->resultSet();
            return $result;
        }

        public function getFilteredCampaignsByType($data) {
            $this->db->query("SELECT campaigns.id, campaigns.campaign_name, 
            (SELECT SUM(orders.order_value) FROM orders WHERE orders.campaign_id = campaigns.id) AS total_revenue
            FROM campaigns
            WHERE campaigns.campaign_type = :campaign_type
            ORDER BY campaigns.id");

            //Bind values
            $this->db->bind(':campaign_type', $data['campaign_type']);

            $result = $this->db->resultSet();
            return $result;
        }
    }