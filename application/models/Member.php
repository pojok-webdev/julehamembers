<?php
Class Member extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets($params){
        $sql = ' select a.id,a.nickname,a.firstname,a.address,a.lastname,a.position,birthdate from members a ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function getpaid($params){
        $sql = ' select a.id,a.name,a.cp,a.address,a.phone,a.district from locations a ';
        $sql.= ' right outer join (select id from receipts where monthyear="'.$params['monthyear'].'") b on b.id=a.id ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function getattrib($id){
        $sql = 'select a.id,a.name,a.address,a.district,a.cp from locations a ';
        $sql.= 'where a.id='.$id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
            $obj = $que->result();
            return array(
                'id'=>$obj[0]->id,
                'name'=>$obj[0]->name,
                'address'=>$obj[0]->address,
                'district'=>$obj[0]->district,
                'cp'=>$obj[0]->cp
            );
        }else{
            return false;
        }
    }
    function savechoosen($params){
        $sql = 'insert into receipts ';
        $sql.= '(id,monthyear,paymentdate) ';
        $sql.= 'select id,"'.$params['monthyear'].'","'.$params['paymentdate'].'" from locations where id in ('.$params['id'].')';
//        $sql.= 'values ';
//        $sql.= '('.$params['id'].') ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
}
