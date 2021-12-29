<?php
Class Members extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('member');
        $this->load->model('portofolio');
        $this->load->model('certificate');
        $this->load->model('training');
        $this->load->helper('inflector');
        $this->load->library('session');
    }
    function encryptpwd(){
        echo sha1($this->uri->segment(3));
    }
    function index(){
        $objs = $this->member->gets();
//        session_start();
        if(!$this->session->userdata('juleha_id')){
            redirect('/members/login');
        }
        $data = array(
            'objs'=>$objs['res'],
            'title'=>'Keanggotaan Juleha',
            'active'=>array('list'=>'active','profile'=>'')
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
            //session_start();
            $this->session->set_userdata('juleha_id',$params['juleha_id'])  ;
            $this->session->set_userdata('id',$gpw['id']) ;
            $this->session->set_userdata('memberlevel',$gpw['memberlevel'])  ;
            //$_SESSION['juleha_id'] = $params['juleha_id'];
            //$_SESSION['id'] = $gpw['id'];
            //$_SESSION['memberlevel'] = $gpw['memberlevel'];
            redirect('/members/profile');
        }else{
            redirect('/members/login');
        }
    }
    function profile(){
        //session_start();
        $obj = $this->member->get($this->session->juleha_id);
        $data = array(
            'juleha_id' => $this->session->juleha_id,
            'obj'=>$obj['res'],
            'portofolio'=>$this->portofolio->gets($this->session->id),
            'certificate'=>$this->certificate->gets($this->session->id),
            'training'=>$this->training->gets($this->session->id),
            'active'=>array('list'=>'','profile'=>'active')
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
    function save_image(){
        $params = $this->input->post();
        $this->saveImage($params['image'],$params['imagename']);
        //return '{result:"OK"}';
        echo json_encode($params);
    }
    function update(){
        $params = $this->input->post();
        $params['columns']['password'] = sha1($params['columns']['password']);
        echo json_encode($this->member->update($params));
    }
}