<?php ob_start(); ?><?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?><?phpclass Report_model extends CI_Model {    function  __construct() {        parent::__construct();        $this->load->helper('form');        $this->load->library('showuser');        $this->load->library('generated_tanggal');    }        function getReport($limit,$offset)    {        $this->db->join("branches","schedules.idbranches = branches.idbranches");        $this->db->join("exams","schedules.idexams = exams.idexams");        $this->db->join("partners","branches.idpartners = partners.idpartners");        $this->db->where('schedules.schstatus', 0);        $this->db->limit($limit, $offset);        $this->db->order_by('schedules.idschedules', 'DESC');        $this->db->or_where('schedules.schclosingreg <', date("Y-m-d"));                        $q =  $this->db->get("schedules");        return $q->result();    }        public function count_report() {            $this->db->where('schedules.schstatus', 0);            $this->db->or_where('schedules.schclosingreg <', date("Y-m-d"));            $query = $this->db->get("schedules");             return $query->num_rows();     }    public function getTestschedule() {      $partner = $this->uri->segment(3);      $query = $this->db->query('select * from branches where idpartners="'.$partner.'"');      foreach ($query->result() as $row ) { ?>                 <option value="<?php echo $row->idbranches ?>"><?php echo $row->branchname ?></option>     <?php  }    }    public function addschedule() {        $partner = $this->input->post('selectpartner');        $test = $this->input->post('testvenue');        $module = $this->input->post('module');        $date = $this->input->post('date_of_birth');        $closingreg = $this->input->post('closingreg');        $dollar = $this->input->post('dollar');        $gbp = $this->input->post('gbp');        $rupiah = $this->input->post('rupiah');        $maximumuser = $this->input->post('maximumuser');        $isactive = $this->input->post('isactive');        $data = array(            'idbranches' => $test,            'idexams' => $module,            'schdate' => $date,            'schclosingreg' => $closingreg,            'dollar' => $dollar,            'gbp' => $gbp,            'rupiah' => $rupiah,            'maxuser' => $maximumuser,            'schstatus' => $isactive,            'created' => date("Y-m-d H:i:s"),            'createdby' => $this->session->userdata('idusers'),            );        $query = $this->db->insert('schedules',$data);        if($query) {          $status = array('status'=> 'sukses');          echo json_encode($status);        } else {          $status = array('status'=> 'gagal');          echo json_encode($status);        }    }    public function updateschedule() {        $idschedules = $this->input->post('idschedules');        $partner = $this->input->post('selectpartners');        $test = $this->input->post('testvenues');        $module = $this->input->post('modules');        $date = $this->input->post('date_of_birth');        $closingreg = $this->input->post('closingreg');        $dollar = $this->input->post('dollar');        $gbp = $this->input->post('gbp');        $rupiah = $this->input->post('rupiah');        $maximumuser = $this->input->post('maximumuser');        $isactive = $this->input->post('isactive');        $data = array(            'idbranches' => $test,            'idexams' => $module,            'schdate' => $date,            'schclosingreg' => $closingreg,            'dollar' => $dollar,            'gbp' => $gbp,            'rupiah' => $rupiah,            'maxuser' => $maximumuser,            'schstatus' => $isactive,            'created' => date("Y-m-d H:i:s"),            'createdby' => $this->session->userdata('idusers'),            );        $this->db->where('idschedules',$idschedules);            $query = $this->db->update('schedules',$data);        if($query) {          $status = array('statuss'=> 'sukses','idschedules' => $idschedules);          echo '{"result":'.json_encode($status).'}';        } else {          $status = array('status'=> 'gagal');          echo json_encode($status);        }    }    function getnewschedule() {        $this->db->where('schdate >', date("Y-m-d H:i:s"));        $this->db->join("branches","schedules.idbranches = branches.idbranches");        $this->db->join("exams","schedules.idexams = exams.idexams");        $this->db->limit(1);        $this->db->order_by('idschedules', 'DESC');        $q =  $this->db->get("schedules");        return $q->result();    }    function getupdateschedule() {        $this->db->join("branches","schedules.idbranches = branches.idbranches");        $this->db->join("exams","schedules.idexams = exams.idexams");        $this->db->where('schedules.idschedules', $this->uri->segment(3));        $q =  $this->db->get("schedules");        return $q->result();    }    function geteditreport($idschedules) {        $this->db->join("schedules","registrations.idschedules = schedules.idschedules");        $this->db->join("users","registrations.idusers = users.idusers");        $this->db->join("branches","schedules.idbranches = branches.idbranches");        $this->db->join("exams","schedules.idexams = exams.idexams");        $this->db->where('registrations.idschedules',$idschedules);        $q =  $this->db->get("registrations");        return $q->result();    }    function getdatareport($idusers) {        $query = $this->db->query('select * from users where idusers="'.$idusers.'"');        return $query->result();    }    function getpartnername($table,$id) {            $this->db->where('idpartners',$id);            $q = $this->db->get($table);            foreach ($q->result() as $row ) {                $name = $row->partnername;                return $name;            }    }    function getSchedules($idschedules)    {        $this->db->join("branches","schedules.idbranches = branches.idbranches");        $this->db->join("exams","schedules.idexams = exams.idexams");        $this->db->where('idschedules', $idschedules);        $q =  $this->db->get("schedules");        return $q->result();    }}?>