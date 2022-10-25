<?php

    class Sample_model extends CI_model {
        public function __construct() {
            parent:: __construct();

            $this->load->database();
        }

        public function display_emp() {
            $query = $this->db->get('users')->result_array();
            return $query;
        }

        public function display_dev() {
            $query = $this->db->get('devices')->result_array();
            return $query;
        }
    }
?>
