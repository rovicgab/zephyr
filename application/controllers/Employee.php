<?php

class Employee extends CI_Controller{
    public function __construct() {
        parent::__construct();

        $this->load->helper(['form', 'url', 'string']);
        $this->load->library(['form_validation', 'session', 'pagination',]);
        $this->load->model('Employee_model');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('Login');
        }

        if ($this->session->userdata('role') == 'admininistrator') {
            redirect('Admin');
        }

        $data['title'] = 'Calibr8 - My Profile';
        $data['employee'] = $this->Employee_model->get_emp_row($this->session->userdata('id'));
        $this->load->view('include/header', $data);
        $this->load->view('employee_profile_view', $data);
        $this->load->view('include/footer');
    }

    public function reset_password() {
        $reset = $this->input->post('reset-btn');
        
        $this->form_validation->set_rules('oldPass', 'Current Password', 'required|min_length[8]|callback_validate_password' ,array(
            'required' => 'Please provide your %s.',
            'min_length' => '%s should have a minimum of 8 characters.'
        ));

        $this->form_validation->set_rules('newPass', 'New Password', 'required|min_length[8]' ,array(
            'required' => 'Please provide your %s.',
            'min_length' => '%s should have a minimum of 8 characters.'
        ));

        $this->form_validation->set_rules('confNewPass', 'Confirm New Password', 'required|min_length[8]|matches[newPass]' ,array(
            'required' => 'Please confirm your New Password.',
            'min_length' => '%s should have a minimum of 8 characters.',
            'matches' => '%s does not match your New Password.'
        ));

        if(isset($reset)) {
            $newPass = md5($this->input->post('newPass'));

            if($this->form_validation->run() == FALSE) {
                $this->index();
            }else {
                $id = $this->session->userdata('id');
                $info = array(
                   'password' => $newPass
                );

                $this->Employee_model->update_employee($id, $info);
                
                $success = "Password is updated successfully";
                $this->session->set_flashdata('success', $success);
                $this->index();
            }
        }
    }

    public function validate_password($oldPass) {
        $id = $this->session->userdata('id');
        $oldPassword = md5($oldPass);
        $currPass = $this->Employee_model->get_emp_row($id)->password;

        if($oldPassword != $currPass) {
            $this->form_validation->set_message('validate_password', '%s field does not match your current password.');
            return FALSE;
        }

        return TRUE;
    }

    public function devList_view() {
        $page_config = array(
            'base_url' => site_url('Employee/employee_borrowDev_view'),
            'total_rows' => $this->Employee_model->get_dCount(),
            'num_links' => 3,
            'per_page' => 5,

            'full_tag_open' => '<div class="d-flex justify-content-center"><ul class="pagination">',
            'full_tag_close' => '</ul></div>',

            'first_link' => FALSE,
            'last_link' => FALSE,

            'next_link' => '&rsaquo;',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',

            'prev_link' => '&lsaquo;',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',

            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '</span></li>',

            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',

            'attributes' => ['class' => 'page-link']
        );

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($page_config);

        $data['title'] = 'Calibr8 - Device Masterlist';
        $data['devices'] = $this->Employee_model->get_devices_table($page_config['per_page'], $page);
        $data['total'] = $this->Employee_model->get_dCount();
        $this->load->view('include/header', $data);
        $this->load->view('employee_borrowDev_view');
        $this->load->view('include/footer');
    }

    public function searchDev() { //Temporary Search Function
        $search = ($this->input->post("searchTerm")) ? $this->input->post("searchTerm") : "NIL";
        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        $page_config = array(
            'base_url' => site_url('Admin/searchDev/$search'),
            'total_rows' => $this->Employee_model->get_devices_count($search),
            'num_links' => 3,
            'per_page' => 5,

            'full_tag_open' => '<div class="d-flex justify-content-center"><ul class="pagination">',
            'full_tag_close' => '</ul></div>',

            'first_link' => FALSE,
            'last_link' => FALSE,

            'next_link' => '&rsaquo;',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',

            'prev_link' => '&lsaquo;',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',

            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '</span></li>',

            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',

            'attributes' => ['class' => 'page-link']
        );

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($page_config);

        $data['title'] = 'Calibr8 - Employee Masterlist';
        $data['devices'] = $this->Employee_model->get_devices_table($page_config['per_page'], $page, $search);
        $data['total'] = $this->Employee_model->get_dCount();
        $this->load->view('include/header', $data);
        $this->load->view('employee_borrowDev_view');
        $this->load->view('include/footer');
    }
}

?>