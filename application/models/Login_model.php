<?php

    class Login_model extends CI_model {
        public function __construct() {
            parent:: __construct();

            $this->load->database();
        }

        public function login($email, $password) {
            $query = $this->db->get_where('users', ['emp_email' => $email, 'password' => md5($password)]);
            return $query->row();
        }
    }
?>