<?php
Class Members extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('member');
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
    function profile(){
        $this->load->view('members/profile');
    }
    function save(){
        $params = $this->input->post();
        echo json_encode($this->member->save($params));
        $img = $_POST['img'];
        $this->saveImage($img);
    }
    function saveImage($img){
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //saving
        $fileName = 'C:\Users\user\Documents\juleha\members\photo.png';
        file_put_contents($fileName, $fileData);
    }

}