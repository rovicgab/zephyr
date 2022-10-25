<?php 

class Login extends CI_Controller{
    public function __construct() {
        parent::__construct();

        $this->load->helper(['form', 'url']);
        $this->load->library('session');
    }
        
    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('Login');
        }

        $data['title'] = 'Calibr8 - Login';
        $this->load->view('include/header', $data);
        $this->load->view('login_view');
        $this->load->view('include/footer');
    }

    public function login_validate() {
        $submit = $this->input->post('login');

        if(isset($submit)) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $this->load->model('Login_model');
            $account = $this->Login_model->login($email, $password);

            if(isset($account)) {
                if($account->emp_role == 'administrator') {
                    $sess_data = array(
                        'id' => $account->id,
                        'role' => $account->emp_role,
                        'logged_in' => TRUE
                    );

                    $this->session->set_userdata($sess_data);
                    redirect('Admin');
                }

                
                if($account->emp_role == 'executive') {
                    $sess_data = array(
                        'id' => $account->id,
                        'role' => $account->emp_role,
                        'logged_in' => TRUE
                    );

                    $this->session->set_userdata($sess_data);
                    redirect('Executive');
                }

                if($account->emp_role == 'employee') {
                    $sess_data = array(
                        'id' => $account->id,
                        'role' => $account->emp_role,
                        'logged_in' => TRUE
                    );

                    $this->session->set_userdata($sess_data);
                    redirect('Employee');
                }
            }

            $error = 'Invalid username or password';
            $this->session->set_flashdata('error', $error);
            redirect('Login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('Login');
    }

}


?>