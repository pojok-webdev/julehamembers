<?php
Class Member extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets(){
        $sql = ' select a.id,juleha_id,a.nickname,a.firstname,a.address,a.lastname,a.position,birthdate from members a ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function save($params){
        $sql = 'insert into members ';
        $sql.= '';
    }
}
