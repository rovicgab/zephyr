<?php 
    class Sample extends CI_Controller {
        public function __construct() {
            parent::__construct();
    
            $this->load->helper(['form', 'url', 'string']);
            $this->load->library(['form_validation', 'session', 'pagination',]);
            $this->load->model('Sample_model');
        }

        public function index() {
            header('Content-Type: application/json');
            echo json_encode(['name' => 'John Doe']);
    
        }

        


        public function login() {
            header('Content-Type: application/json');


            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            $this->load->model('Login_model');
            $account = $this->Login_model->login($email, $password);


            if(isset($account)) {
                $jwt = new JWT();

                $JwtSecretKey = "DEVIN-Calibr8";
                $data = array(
                    'id' => $account->id,
                    'employee_id' => $account->emp_id,
                    'name' => $account->emp_name,
                    'email' => $account->emp_email,
                    'superior' => $account->superior,
                    'role' => $account->emp_role,
                    'image' => $account->emp_image,
                    'expiration' => (time() * 1000) + 3600 * 1000
                    // (time() * 1000) + 3600 * 1000 - 1hr expiration
                );

                $token = $jwt->encode($data, $JwtSecretKey, 'HS256');
                echo json_encode(['token' => $token, 'message' => 'Success!']);
            } else {
                echo json_encode(['error' => 'Invalid username/password']);
            }

            // if(isset($submit)) {
            //     $email = $this->input->post('email');
            //     $password = $this->input->post('password');
    
            //     $this->load->model('Login_model');
            //     $account = $this->Login_model->login($email, $password);
    
            //     if(isset($account)) {
            //         if($account->emp_role == 'administrator') {
            //             $sess_data = array(
            //                 'id' => $account->id,
            //                 'role' => $account->emp_role,
            //                 'logged_in' => TRUE
            //             );
    
            //             // $this->session->set_userdata($sess_data);
            //             // redirect('Admin');
            //         }
    
            //         // FOR EXECUTIVE
            //         // if($account->emp_role == 'executive') {
            //         //     $sess_data = array(
            //         //         'id' => $account->id,
            //         //         'role' => $account->emp_role,
            //         //         'logged_in' => TRUE
            //         //     );
    
            //         //     $this->session->set_userdata($sess_data);
            //         //     redirect('');
            //         // }
    
            //         if($account->emp_role == 'employee') {
            //             $sess_data = array(
            //                 'id' => $account->id,
            //                 'role' => $account->emp_role,
            //                 'logged_in' => TRUE
            //             );
    
            //             // $this->session->set_userdata($sess_data);
            //             // redirect('Employee');
            //         }
            //     }
    
            //     // $error = 'Invalid username or password';
            //     // $this->session->set_flashdata('error', $error);
            //     // redirect('Login');
            // }
        }

        public function token() { //JWT Token
            $jwt = new JWT();

            $JwtSecretKey = "DEVIN-Calibr8";
            $data = array(
                'userId' => 568,
                'email' => 'admin@gmail.com',
                'userType' => 'admin'
            );

            $token = $jwt->encode($data, $JwtSecretKey, 'HS256');
            echo json_encode($token);
        }

        public function decode_token() { //Error Handling - status code(403)
            $headers = apache_request_headers();
            $token = $headers['Authorization'];
            // echo json_encode($token);

            $jwt = new JWT();
            $JwtSecretKey = "DEVIN-Calibr8";
            
            $decoded_token = $jwt->decode($token, $JwtSecretKey, 'HS256');

            //this will return std_object
            // echo "<pre>";
            // print_r($decoded_token);

            //it will return JSON
            $token1 = $jwt->jsonEncode($decoded_token);
            // return $token1;

            $value = json_decode(json_encode($decoded_token), true);
            $expiration = $value['expiration'];
            // echo json_encode($expiration);
            // echo json_encode($decoded_token);

            if(time() * 1000 >= $expiration) { //Error Handling
                echo 'Token is expired';
            } else {
                echo json_encode($decoded_token);
            }
            return $token1;
        }

        public function display_emp() {
            header('Content-Type: application/json');
            $token = $this->decode_token();

            if(isset($token)) {
                $this->load->model('Sample_model');
                $response = $this->Sample_model->display_emp();
                echo json_encode($response);

            }


            // $this->load->model('Sample_model');
            // $response = $this->Sample_model->display_emp();
            // echo json_encode($response);
        }

        public function display_dev() {
            header('Content-Type: application/json');
            $token = $this->decode_token();

            if(isset($token)) {
                $this->load->model('Sample_model');
                $response = $this->Sample_model->display_dev();
                echo json_encode($response);
            }
        }

        public function display_employee() {
            header('Content-Type: application/json');
            
            $this->load->model('Sample_model');
            $response = $this->Sample_model->display_dev();
            echo json_encode($response);

        }

        public function display_device() {
            header('Content-Type: application/json');

            $this->load->model('Sample_model');
            $response = $this->Sample_model->display_dev();
            echo json_encode($response);
        }
    }
?>