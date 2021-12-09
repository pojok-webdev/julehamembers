<?php
Class Receipts extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('receipt');
    }
    function getmonths(){
        return array(
            '01'=>'Januari',
            '02'=>'Februari',
            '03'=>'Maret',
            '04'=>'April',
            '05'=>'Mei',
            '06'=>'Juni',
            '07'=>'Juli',
            '08'=>'Agustus',
            '09'=>'September',
            '10'=>'Oktober',
            '11'=>'Nopember',
            '12'=>'Desember',
        );
    }
    function getyears(){
        return array(
            '2021'=>'2021',
            '2022'=>'2022',
            '2023'=>'2023'
        );
    }
    function index(){
        if($this->uri->total_segments()>2){
            $monthyear = $this->uri->segment(3);
        }else{
            $monthyear = '012021';
        }
        $month = substr($monthyear,0,2);
        $year = substr($monthyear,2,4);
        $objs = $this->receipt->getunpaid(array('monthyear'=>$monthyear));
        $data = array(
            'objs'=>$objs['res'],
            'month'=>$month,
            'year'=>$year,
            'months'=>$this->getmonths(),
            'years'=>$this->getyears()
        );
        $this->load->view('receipts/receipt',$data);
    }
    function testattrib(){
        $this->load->model('receipt');
        print_r ($this->receipt->getattrib(41));
    }
    function getattribs($params){
        $out = array();
        foreach($params as $param){
            array_push($out,$this->receipt->getattrib($param));
        }
        return $out;
    }
    function handler(){
        $params = $this->input->post();
        if(1==1){
            print_r($params);
        }
        if(array_key_exists('reload',$params)){
            header('Location: '.base_url().'receipts/index/'.$params['month'].$params['year']);
        }
        if(array_key_exists('print',$params)){
            $x = $this->getattribs($params['checme']);
            $data = array(
                'objs'=>$x,
                'months'=>$this->getmonths(),
                'years'=>$this->getyears(),
                'month'=>$params['month'],
                'year'=>$params['year']
        
            );
            $this->load->view('receipts/print',$data);    
        }
    }
    function savechoosen($params){
        $this->receipt->savechoosen($params);
    }
    function save($params){
        $this->savechoosen(
            array(
                'id'=>implode(",",array_map(function($entry){
                    return  $entry;
                },$params['outletid'])),
                'monthyear'=>$params['month'].$params['year'],
                'paymentdate'=>$params['paymentdate']),
            );
        header('Location: '.base_url().'/receipts');
    }
    function printhandler(){
        $params = $this->input->post();
        if(1==2){
            print_r($params);
        }
        if(array_key_exists('save',$params)){
            $this->save($params);
        }
        if(array_key_exists('saveandprint',$params)){
            $ids = implode("-",$params['outletid']);
            $this->save($params);
            header('Location: '.base_url().'receipts/receipttemplate/'.$ids.'/'.$params['month'].$params['year']);
        }
        if(array_key_exists('home',$params)){
            header('Location: '.base_url().'receipts/');
        }
    }
    function gethumanmonthyear($monthyear){
        $month = substr($monthyear,0,2);
        $months = $this->getmonths();
        $year = substr($monthyear,2,4);
        return $months[$month].' ' . $year;
    }
    function receipttemplate(){
        $ids = $this->uri->segment(3);
        $arr = array();
        foreach(explode("-",$ids) as $id){
            array_push($arr,$this->receipt->getattrib($id));
        }
        $data = array(
            'ids'=>$arr,
            'monthyear'=>$this->gethumanmonthyear($this->uri->segment(4))
        );
        $this->load->view('receipts/receipttemplate',$data);
    }
    function paid(){
        if($this->uri->total_segments()>2){
            $monthyear = $this->uri->segment(3);
        }else{
            $monthyear = '012021';
        }
        $month = substr($monthyear,0,2);
        $year = substr($monthyear,2,4);
        $objs = $this->receipt->getpaid(array('monthyear'=>$monthyear));
        $data = array(
            'objs'=>$objs['res'],
            'month'=>$month,
            'year'=>$year,
            'months'=>$this->getmonths(),
            'years'=>$this->getyears()
        );
        $this->load->view('receipts/paid',$data);
    }
    function paidhandler(){
        $params = $this->input->post();
        if(array_key_exists('reload',$params)){
            header('Location: '.base_url().'receipts/paid/'.$params['month'].$params['year']);
        }
        if(array_key_exists('print',$params)){
            $x = $this->getattribs($params['checme']);
            $data = array(
                'objs'=>$x,
                'months'=>$this->getmonths(),
                'years'=>$this->getyears(),
                'month'=>'01',
                'year'=>'2021'
        
            );
            $this->load->view('receipts/print',$data);    
        }
    }
}