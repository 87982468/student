<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form'));
    }

    function index() {
        $this->load->view('login');
    }

    function check_login() {
        //表单验证
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        //$this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_email_check');
        $this->form_validation->set_rules('email', 'email', 'required|callback_email_check');
        $this->form_validation->set_rules('password', 'password', 'required|callback_password_check');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('login');
        }
        else
        {
            //设置cookie
            $cookie=array(
                'name'=>'lq',
                'value'=>'admin',
                'expire'=>0 //浏览器关闭的时候失效
            );
             $this->session->set_userdata(array('lq'=>'admin'));
            $this->load->view('login');
        }
    }

    function email_check() {
        $email = $this->input->post('email');
        if ( strtolower($email) == 'admin') {
            return true;
        } else {
            $this->form_validation->set_message('email_check',' 请用管理员登陆!');
            return false;
        }
    }

    function password_check() {
        $pwd = $this->input->post('password');
        if ( strtolower($pwd) == 'cmm1308') {
            return true;
        } else {
            $this->form_validation->set_message('password_check','  密码错误!');
            return false;
        }
    }

    function login_out(){
        $this->session->unset_userdata('lq');
        redirect(base_url()."ci/index.php/index");
    }
}
?>