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
    function save(){
        $params = $this->input->post();
        echo json_encode($this->member->save($params));
    }


}