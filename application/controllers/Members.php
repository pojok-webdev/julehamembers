<?php
Class Members extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('member');
    }
    function encryptpwd(){
        echo sha1($this->uri->segment(3));
    }
    function index(){
        $objs = $this->member->gets();
        $data = array(
            'objs'=>$objs['res'],
            'title'=>'Keanggotaan Juleha'
        );
        $this->load->view('members/all',$data);
    }
    function login(){
        $this->load->view('members/login');
    }
    function loginhandler(){
        $params = $this->input->post();
        $gpw = $this->member->getpassword($params['juleha_id']);
        if($gpw['password']===sha1($params['password'])){
            session_start();
            $_SESSION['juleha_id'] = $params['juleha_id'];
            redirect('/members/profile');
        }else{
            redirect('/members/login');
        }
    }
    function profile(){
        session_start();
        $obj = $this->member->get($_SESSION['juleha_id']);
        $data = array(
            'juleha_id' => $_SESSION['juleha_id'],
            'obj'=>$obj['res']
        );       
        $this->load->view('members/profile',$data);
    }
    function save(){
        $params = $this->input->post();
        $params['columns']['password'] = sha1($params['columns']['password']);
        echo json_encode($this->member->save($params));
        $img = $_POST['img'];
        $this->saveImage($img,$params['columns']['juleha_id']);
    }
    function saveImage($img,$juleha_id){
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        $fileName = 'C:\Users\user\Documents\juleha\members\\'.$juleha_id.'.jpg';

        file_put_contents($fileName, $fileData);
    }
    function update(){
        $params = $this->input->post();
        $params['columns']['password'] = sha1($params['columns']['password']);
        echo json_encode($this->member->update($params));
    }
}