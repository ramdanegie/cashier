<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_login_info($username) {
        $arr = array('username' => $username, 'active' => '1');
        $this->db->where($arr);
        $this->db->limit(1);
        $query = $this->db->get('sys_users');
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
 function get_menu($level) {

        $sql = 'SELECT sys_menu.* FROM sys_access INNER JOIN sys_menu 
                ON (sys_access.id_menu = sys_menu.id_menu) WHERE 
                sys_access.level="' . $level . '" AND sys_menu.tipe="0" 
                ORDER BY sys_menu.seq';
        $result = $this->db->query($sql);
        $menu = '';
        $menu_child = '';
       
       if($result->num_rows()>0){
            foreach ($result->result() as $parent){
                $li_parent='';
                
                $sql='SELECT sys_menu.* FROM sys_access INNER JOIN sys_menu 
                        ON (sys_access.id_menu = sys_menu.id_menu) WHERE 
                        sys_access.level="'.$level.'" AND sys_menu.tipe="1" AND parent="'.$parent->id_menu.' "
                        ORDER BY sys_menu.seq';
                      
                $result_child=$this->db->query($sql);
                if($result_child->num_rows()>0){
                   $li_parent='
								<li>
								<a><i class="'.$parent->icon.'"></i>'.$parent->name.' <span class="fa fa-chevron-down"></span></a>';
								
                    $menu_child='<ul class="nav child_menu">';
                    foreach ($result_child->result() as $child){                        

                        $menu_child=$menu_child.'<li><a href="'.site_url().$child->url.'">'.$child->name.'</a></li>';
                    }
                    $menu_child=$menu_child.'</ul>';
                }
                $menu=$menu.'
                            '.$li_parent.'
                                
                                    
                                    '.$menu_child.'
                                
                            </li>';
            }
        }
        
        return $menu;
         
    }


    function get_akses($id_menu, $level_cookie) {
        $sql = 'SELECT COUNT(*) AS hasil FROM sys_access WHERE
                sys_access.id_menu="' . $id_menu . '" AND sys_access.level="' . $level_cookie . '"';
        $hasil = $this->db->query($sql)->row()->hasil;

        return $hasil;
    }
     function get($start, $rows, $search) {
            $sql = 'SELECT * from sys_level WHERE levels LIKE "%' . $search . '%" OR description LIKE "%' . $search . '%" 
                ORDER BY levels ASC LIMIT ' . $start . ',' . $rows;

            return $this->db->query($sql);
        }
          function get_c($search) {
            $sql = 'SELECT count(*) as hasil from sys_level WHERE levels LIKE "%' . $search . '%" OR description LIKE "%' . $search . '%"';
            return $this->db->query($sql);
        }
}