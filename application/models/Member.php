<?php
Class Member extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets(){
        $sql = ' select a.id,juleha_id,region,a.nickname,a.firstname,a.address,a.lastname,a.position,birthdate from members a ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function save($params){
        $keys = array();$vals = array();
        $sql = 'insert into members ';
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql.= '('.implode(",",$keys).")";
        $sql.= ' values ';
        $sql.= '('.implode(",",$vals).')';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'id'=>$ci->db->insert_id(),
            'sql'=>$sql
        );
    }
}
