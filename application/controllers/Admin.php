<?php

class Admin extends CI_Controller{
    public function __construct() {
        parent::__construct();

        $this->load->helper(['form', 'url', 'string']);
        $this->load->library(['form_validation', 'session', 'pagination',]);
        $this->load->model('Admin_model');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('Login');
        }

        if ($this->session->userdata('role') == 'employee') {
            redirect('Employee');
        }
        
        $data['title'] = 'Calibr8 - Admin Dashboard';
        $this->load->view('include/header', $data);
        $this->load->view('admin_empReg_view'); //Temporary view to be loaded
        $this->load->view('include/footer');
    }

    //Employee Masterlist
    public function emp_masterlist_view() {
        $page_config = array(
            'base_url' => site_url('Admin/emp_masterlist_view'),
            'total_rows' => $this->Admin_model->get_uCount(),
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

        $data['title'] = 'Calibr8 - Employee Masterlist';
        $data['employees'] = $this->Admin_model->get_users_table($page_config['per_page'], $page, NULL);
        $data['total'] = $this->Admin_model->get_uCount();
        $this->load->view('include/header', $data);
        $this->load->view('admin_emp_masterlist');
        $this->load->view('include/footer');
    }

    public function searchEmp() { //Temporary Search Function
        $search = ($this->input->post("searchTerm")) ? $this->input->post("searchTerm") : "NIL";
        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        $page_config = array(
            'base_url' => site_url('Admin/searchEmp/$search'),
            'total_rows' => $this->Admin_model->get_users_count($search),
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
        $data['employees'] = $this->Admin_model->get_users_table($page_config['per_page'], $page, $search);
        $data['total'] = $this->Admin_model->get_uCount();
        $this->load->view('include/header', $data);
        $this->load->view('admin_emp_masterlist');
        $this->load->view('include/footer');
    }

    public function employee_view($id) { //Under Employee Masterlist
        $data['title'] = "Calibr8 - View Employee Details";
        $data['employee'] = $this->Admin_model->get_emp_row($id);

        $this->load->view('include/header', $data);
        $this->load->view('admin_employee_view', $data);
        $this->load->view('include/footer');
    }

    public function remove_employee($id) { //Temporary remove func?
        $this->Admin_model->remove_employee($id);
        redirect('Admin/emp_masterlist_view');
    }

    public function editEmp_view($id) { //Under Employee Masterlist
        $data['title'] = "Calibr8 - Edit Employee Details";
        $data['employee'] = $this->Admin_model->get_emp_row($id);

        $this->load->view('include/header', $data);
        $this->load->view('admin_editEmp_view', $data);
        $this->load->view('include/footer');
    }

    public function editEmp_details() {
        $image_config = array(
            'upload_path' => './assets/employee_image',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 5000000000,
            'max_width' => 204800,
            'max_height' => 204800
        );
        
        $this->load->library('upload', $image_config);
        $this->upload->initialize($image_config);

        $this->form_validation->set_rules('empname', 'Employee Name', 'required', array(
            'requied' => '%s is required.'
        ));

        $this->form_validation->set_rules('roles', 'Employee Roles', 'required', array(
            'requied' => '%s is required.'
        ));

        $this->form_validation->set_rules('rfid', 'RFID', 'required', array(
            'requied' => '%s is required.'
        ));

        if($this->upload->do_upload('employee_image') == FALSE) {
            $this->form_validation->set_rules('employee_image', 'Employee Image', 'required');
        }

        if($this->form_validation->run() == FALSE) {
            $id = $this->input->post('emp-id');
            $this->editEmp_view($id);
        } else {
            $image_name = (!$this->upload->do_upload('employee_image')) ? null : $this->upload->data('file_name');
            $save = $this->input->post('reg-dev');

            if(isset($save)) {

                $id = $this->input->post('emp-id');
                $info = array(
                    'emp_name' => $this->input->post('empname'),
                    'emp_role' => $this->input->post('roles'),
                    'emp_image' => $image_name,
                    'rfid' => $this->input->post('rfid')
                );

                $this->Admin_model->update_employee($id, $info);

                $success = "Employee details is updated successfully";
                $this->session->set_flashdata('success', $success);
                $this->editEmp_view($id);

            }
        }

        $cancel = $this->input->post('cancel-btn');
        
        if(isset($cancel)) {
            redirect('Admin/emp_masterlist_view');
        }
    }




    

    //Device Masterlist
    public function dev_masterlist_view() {
        $page_config = array(
            'base_url' => site_url('Admin/dev_masterlist_view'),
            'total_rows' => $this->Admin_model->get_dCount(),
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
        $data['devices'] = $this->Admin_model->get_devices_table($page_config['per_page'], $page);
        $data['total'] = $this->Admin_model->get_dCount();
        $this->load->view('include/header', $data);
        $this->load->view('admin_dev_masterlist');
        $this->load->view('include/footer');
    }

    public function searchDev() { //Temporary Search Function
        $search = ($this->input->post("searchTerm")) ? $this->input->post("searchTerm") : "NIL";
        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        $page_config = array(
            'base_url' => site_url('Admin/searchDev/$search'),
            'total_rows' => $this->Admin_model->get_devices_count($search),
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
        $data['devices'] = $this->Admin_model->get_devices_table($page_config['per_page'], $page, $search);
        $data['total'] = $this->Admin_model->get_dCount();
        $this->load->view('include/header', $data);
        $this->load->view('admin_dev_masterlist');
        $this->load->view('include/footer');
    }

    public function device_view($id) { //Under device masterlist
        $data['title'] = "Calibr8 - View Device Details";
        $data['device'] = $this->Admin_model->get_dev_row($id);

        $this->load->view('include/header', $data);
        $this->load->view('admin_device_view', $data);
        $this->load->view('include/footer');
    }

    public function remove_device($id) { //Temporary remove func?
        $this->Admin_model->remove_device($id);
        redirect('Admin/dev_masterlist_view');
    }

    public function editDev_view($id) { //Under device masterlist
        $data['title'] = "Calibr8 - Edit Device Details";
        $data['device'] = $this->Admin_model->get_dev_row($id);

        $this->load->view('include/header', $data);
        $this->load->view('admin_editDev_view', $data);
        $this->load->view('include/footer');
    }

    public function editDev_details() {
        $image_config = array(
            'upload_path' => './assets/device_image',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 5000000000,
            'max_width' => 204800,
            'max_height' => 204800
        );
        
        $this->load->library('upload', $image_config);
        $this->upload->initialize($image_config);

        $this->form_validation->set_rules('devicename', 'Device Name', 'required', array(
            'required' => '%s is required.'
        ));

        $this->form_validation->set_rules('roles', 'Allowed Roles', 'required', array(
            'required' => '%s is required.'
        ));

        $this->form_validation->set_rules('rfid', 'RFID', 'required', array(
            'required' => '%s is required.'
        ));

        $this->form_validation->set_rules('prev_device_status', 'Previous Device Status', 'required', array(
            'required' => '%s is required.'
        ));

        $this->form_validation->set_rules('cur_device_status', 'Current Device Status', 'required', array(
            'required' => '%s is required.'
        ));

        if($this->upload->do_upload('device_image') == FALSE) {
            $this->form_validation->set_rules('device_image', 'Device Image', 'required');
        }

        if($this->form_validation->run() == FALSE) {
            $id = $this->input->post('dev-id');
            $this->editDev_view($id);
        } else {
            $image_name = (!$this->upload->do_upload('device_image')) ? null : $this->upload->data('file_name');
            $save = $this->input->post('reg-dev');

            if(isset($save)) {

                $id = $this->input->post('dev-id');
                $info = array(
                    'dev_name' => $this->input->post('devicename'),
                    'allowed_roles' => $this->input->post('roles'),
                    'rfid' => $this->input->post('rfid'),
                    'prev_status' => $this->input->post('prev_device_status'),
                    'cur_status' => $this->input->post('cur_device_status'),
                    'dev_image' => $image_name
                );

                $this->Admin_model->update_device($id, $info);

                $success = "Device details is updated successfully";
                $this->session->set_flashdata('success', $success);
                $this->editDev_view($id);

            }
        }

        $cancel = $this->input->post('cancel-btn');
        
        if(isset($cancel)) {
            redirect('Admin/dev_masterlist_view');
        }
    }





    //Registration Section
    public function empReg_view() {
        $data['title'] = 'Calibr8 - Employee Registration';
        $this->load->view('include/header', $data);
        $this->load->view('admin_empReg_view');
        $this->load->view('include/footer');
    }

    public function employee_registration() {
        $image_config = array(
            'upload_path' => './assets/employee_image',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 5000000000,
            'max_width' => 204800,
            'max_height' => 204800
        );

        $this->load->library('upload', $image_config);
        $this->upload->initialize($image_config);

        $this->form_validation->set_rules('empid', 'Employee ID', 'required|is_unique[users.emp_id]', array(
            'required' => '%s is required.',
            'is_unique' => 'This %s is already registered.'
        ));
        $this->form_validation->set_rules('empname', 'Employee Name', 'required', array(
            'required' => '%s is required.'
        ));
        $this->form_validation->set_rules('email', 'Employee Email', 'required|valid_email|is_unique[users.emp_email]', array(
            'required' => '%s is required.',
            'valid_email' => 'Please enter a valid %s.',
            'is_unique' => 'This %s is already registered.'
        ));
        $this->form_validation->set_rules('superior', 'Direct Superior', 'required', array(
            'required' => '%s is required.'
        ));
        $this->form_validation->set_rules('roles', 'Employee Role', 'required', array(
            'required' => '%s is required.'
        ));
        $this->form_validation->set_rules('init-pass', 'Initial Password', 'required|min_length[8]', array(
            'required' => '%s is required.',
            'min_length' => '%s should have a minimum of 8 characters'
        ));

        if($this->upload->do_upload('employee_image') == FALSE) {
            $this->form_validation->set_rules('employee_image', 'Employee Image', 'required');
        }

        if($this->form_validation->run() == FALSE) {
            $this->empReg_view();
        } else {
            $image_name = (!$this->upload->do_upload('employee_image')) ? null : $this->upload->data('file_name');
            $register = $this->input->post('reg-emp');

            if(isset($register)) {

                $id = $this->session->userdata('id');
                $info = array(
                    'emp_id' => $this->input->post('empid'),
                    'emp_name' => $this->input->post('empname'),
                    'emp_email' => $this->input->post('email'),
                    'superior' => $this->input->post('superior'),
                    'emp_role' => $this->input->post('roles'),
                    'password' => md5($this->input->post('init-pass')),
                    'emp_image' => $image_name,
                    'rfid' => 'None'
                );

                $this->Admin_model->employee_registration($info);

                $success = "Employee is registered successfully";
                $this->session->set_flashdata('success', $success);
                redirect('Admin/employee_registration');
            }
        }
    }

    public function devReg_view() {

        $data['title'] = 'Calibr8 - Device Registration';
        $this->load->view('include/header', $data);
        $this->load->view('admin_devReg_view');
        $this->load->view('include/footer');
    }

    public function device_registration() {
        $image_config = array(
            'upload_path' => './assets/device_image',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 5000000000,
            'max_width' => 204800,
            'max_height' => 204800
        );

        $this->load->library('upload', $image_config);
        $this->upload->initialize($image_config);

        $this->form_validation->set_rules('uniquenum', 'Device Unique Number', 'required|alpha_numeric|is_unique[devices.unique_num]', array(
            'required' => '%s is required.',
            'alpha_numeric' => '%s should only contain alpha numeric characters.',
            'is_unique' => 'This %s is already registered.'
        ));
        $this->form_validation->set_rules('devicename', 'Device Name', 'required', array(
            'required' => '%s is required.'
        ));
        $this->form_validation->set_rules('model', 'Device Model', 'required|alpha_numeric_spaces', array(
            'required' => '%s is required.',
            'alpha_numeric' => '%s should only contain alpha numeric characters.'
        ));
        $this->form_validation->set_rules('roles', 'Allowed Roles', 'required', array(
            'required' => 'Please set %s',
        ));
        $this->form_validation->set_rules('manuf', 'Manufacturer', 'required|alpha_numeric', array(
            'required' => '%s is required.',
            'alpha_numeric' => '%s should only contain alpha numeric characters.'
        ));
        $this->form_validation->set_rules('specs', 'Specifications', 'required', array(
            'required' => '%s is required.',
        ));

        if($this->upload->do_upload('device_image') == FALSE) {
            $this->form_validation->set_rules('device_image', 'Device Image', 'required');
        }

        if($this->form_validation->run() == FALSE) {
            $this->devReg_view();
        } else {
            $image_name = (!$this->upload->do_upload('device_image')) ? null : $this->upload->data('file_name');
            $register = $this->input->post('reg-dev');

            if(isset($register)) {

                $info = array(
                    'unique_num' => $this->input->post('uniquenum'),
                    'dev_name' => $this->input->post('devicename'),
                    'dev_model' => $this->input->post('model'),
                    'allowed_roles' => $this->input->post('roles'),
                    'manufacturer' => $this->input->post('manuf'),
                    'specs' => nl2br($this->input->post('specs')),
                    'dev_image' => $image_name,
                    'rfid' => 'None',
                    'cur_status' => 'Available',
                    'prev_status' => 'None'
                );

                $this->Admin_model->device_registration($info);

                $success = "Device is registered successfully";
                $this->session->set_flashdata('success', $success);
                redirect('Admin/device_registration');
            }
        }
    }


}

?>