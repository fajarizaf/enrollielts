<?php ob_start(); ?><?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?><?phpclass App_model extends CI_Model {    function  __construct() {        parent::__construct();        $this->load->helper('form');        $this->load->library('generated_tanggal');    }        private $table_name = 'custom_post';    private $table_name1 = 'contact';    private $primary_key = 'no';    function get_data($table) {    $data = $this->db->get($table);    return $data->result();}function get_data_desc($table) {    $this->db->order_by('idcity', 'DESC');    $data = $this->db->get($table);    return $data->result();}function get_data_new($table) {    $this->db->limit(5);    $this->db->order_by('no','desc');    $data = $this->db->get($table);    return $data->result();}                public function count_table_user($table,$type_user) {            $query = $this->db->query('select * from '.$table.' where status="'.$type_user.'"  ');             return $query->num_rows();         }                function getSelectedDataLike($table,$where) {            $this->db->limit(6);            $this->db->like('title_post',$where);            $data1 = $this->db->get($table);            return $data1->result();        }        function search($table,$field,$keyword) {            $this->db->like($field,$keyword);            $data1 = $this->db->get($table);            return $data1->result();        }public function getSelectedData($table,$data)	{		$data1 =  $this->db->get_where($table,$data);        return $data1->result();	}public function getSelectedDatareview($table,$data) {    $this->db->limit(4);    $data1 =  $this->db->get_where($table,$data);    return $data1->result();}            public function getSelectedDataDesc($table,$data)	{    $this->db->order_by("no", "Desc");	$data1 =  $this->db->get_where($table,$data);    return $data1->result();	}                public function getnewdata1($table)  	{        $this->db->limit(12);        $this->db->order_by("no", "desc");		$data1 =  $this->db->get($table);        return $data1->result();	}          public function count_table_rows($table) {            return $this->db->count_all($table);        }        public function countdata($table,$where,$value) {           $this->db->where($where, $value );            $query =  $this->db->get($table);           return $query->num_rows();        }                          public function getallpost($table,$limit,$offset) {            $this->db->limit($limit);            $this->db->offset($offset);            $this->db->order_by("no", "desc");		    $query =  $this->db->get($table);            return $query->result();         }        function searchproductt($param) {            $q = $this->db->query("select * from product where title_product like '".$param."' ");            return $q;        }          public function getDataDescLimit($table,$limit)	       {             $this->db->limit($limit);             $this->db->order_by("no", "desc");		     $data1 =  $this->db->get($table);             return $data1->result();	       }                public function getDataDescLimitwhere($table,$limit,$where)	       {              $this->db->limit($limit);              $this->db->order_by("no", "desc");		      $data1 =  $this->db->get_where($table,$where);              return $data1->result();	       }                public function nextPage($page) {           $query = $this->db->query('SELECT * FROM custom_post WHERE no > '.$page.' ORDER BY no LIMIT 1');            return $query->result();        }                        public function prevPage($page) {            $query = $this->db->query('SELECT * FROM custom_post WHERE no < '.$page.' ORDER BY no DESC LIMIT 1');            return $query->result();        }                     public function getDay($date) {            $query = $this->db->query('SELECT DAYNAME("'.$date.'") AS DAY');            return $query->result();        }            public function getCountBooked($idschedules) {                $this->db->where('registrationspayment', 'PAID');                 $this->db->where('idschedules', $idschedules);                $query = $this->db->get('registrations');                return $query->num_rows();            }                        }                                           ?>