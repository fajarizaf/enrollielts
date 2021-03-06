<?php ob_start() ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php


class Schedule extends CI_Controller {


    public function  __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('schedule_model');
        $this->load->model('user_model');
        $this->load->model('app_model');
        $this->load->helper(array('form','url'));
        $this->load->library(array('table','form_validation'));
        $this->load->library('pagination');
        $this->load->library('showuser');
        $this->load->library('encrypt');
        $this->load->helper('text');      
    }



    public function index($offset = NULL) {

            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'schedule/page/';
            $config['total_rows'] = $this->schedule_model->count_schedule();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';



      if($this->session->userdata('login') == 'true') {
        // cek user previliages
        $checkroles = $this->user_model->cek_roles($this->uri->segment(1));

            if($checkroles == 1) {
                $idroles = $this->session->userdata('statususer');
                $where['partnerstatus'] = 1;
                $data['partner'] = $this->app_model->getSelectedData('partners',$where);
                $data['menuadmin'] = $this->user_model->menuadmin($idroles);
                $data['schedule'] = $this->schedule_model->getSchedule($limit,$offset);
                $data['venuetest'] = $this->app_model->get_data('branches');
                $this->pagination->initialize($config);

                $this->load->view('global/header', $data);
                $this->load->view('schedule',$data);
                $this->load->view('widget/addschedule',$data);
                $this->load->view('widget/editschedule',$data);
                $this->load->view('global/footer');

           } else {
           redirect('register'); 
           }


      } else {
        redirect('register');
      }

    }



     public function page($offset = NULL) {

            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'schedule/page/';
            $config['total_rows'] = $this->schedule_model->count_schedule();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


                $idusers = $this->session->userdata('idusers');
                $data['schedule'] = $this->schedule_model->getSchedule($limit,$offset);
                $this->pagination->initialize($config);

                $this->load->view('refresh',$data);
    }


    public function getTestschedule() {
      $this->schedule_model->getTestschedule();
    }


    public function addschedule() {
        $this->schedule_model->addschedule();
    }

    public function refreshList($offset = NULL) {
      $limit = 10;
       if( is_null ($offset)) { $offset = 0; } else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'schedule/page/';
            $config['total_rows'] = $this->schedule_model->count_schedule();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
      
      $data['schedule'] = $this->schedule_model->getSchedule($limit,$offset);
      $this->pagination->initialize($config);
      $this->load->view('refresh',$data);
    }


    function getNewSchedule() {
      $query = $this->schedule_model->getnewschedule(); ?>

     <?php 
      $i = 1;  
      foreach ( $query as $row ) { ?>
         
      <tr atr="<?php echo $row->idschedules ?>" id="<?php echo $row->idschedules; ?>" <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="background:#efefef;"  <?php  }  ?>>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->examname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->getDay($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->branchname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><span class="label label-warning" style="padding-left:10px;padding-right:10px;"><?php echo $this->showuser->getCountBooked($row->idschedules); ?></span></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->maxuser; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><div url="<?php echo base_url() ?>schedule/editschedules/<?php echo $row->idschedules; ?>" href="#editschedule" data-toggle="modal" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idschedules; ?>"  class="icondelete"></div></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?><span class="label label-info" style="padding-left:10px;padding-right:10px;">Full</span><?php } else { echo '-'; } ?></td>

      </tr>

          <?php $i++ ?>
     <?php } ?>

     <?php
    }


    function getUpdateSchedule() {
      $query = $this->schedule_model->getupdateschedule(); ?>

     <?php 
      $i = 1;  
      foreach ( $query as $row ) { ?>
         
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->examname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->getDay($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->branchname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><span class="label label-warning" style="padding-left:10px;padding-right:10px;"><?php echo $this->showuser->getCountBooked($row->idschedules); ?></span></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->maxuser; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><div url="<?php echo base_url() ?>schedule/editschedules/<?php echo $row->idschedules; ?>" href="#editschedule" data-toggle="modal" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idschedules; ?>"  class="icondelete"></div></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?><span class="label label-info" style="padding-left:10px;padding-right:10px;">Full</span><?php } else { echo '-'; } ?></td>

          <?php $i++ ?>
     <?php } ?>

     <?php
    }



    function editschedules() {
        $data['dataschedules'] = $this->schedule_model->geteditschedule();
        $wheres['partnerstatus'] = 1;
        $data['partner'] = $this->app_model->getSelectedData('partners',$wheres);
        $idpartners = $this->schedule_model->geteditschedule();



        foreach ($idpartners as $row){
            $id = $row->idpartners;
            $whered['idpartners'] = $id;
            $data['partnername'] = $this->schedule_model->getpartnername('partners',$id);
            $data['idpartner'] = $id;
            $data['partnerselected'] = $this->app_model->getSelectedData('branches',$whered);    
        }
        

        $this->load->view('editschedule',$data);

    }

    function updateschedule() {
        $this->schedule_model->updateschedule();
    }

    function deleteschedule() {
        $this->schedule_model->deleteschedules();
    }

    function filterbydate($offset = NULL) {
         $limit = 10;
       if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
       $date = $this->input->post('date');

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'schedule/pagedate/'.$date.'';
            $config['total_rows'] = $this->schedule_model->count_scheduledate($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


       $data['schedule'] = $this->schedule_model->filterbydate($date,$limit,$offset);
       $this->pagination->initialize($config);
       $this->load->view('refresh',$data);
    }


    public function pagedate($offset = NULL) {

            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
            $date = $this->uri->segment(3);

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'schedule/pagedate/'.$date.'';
            $config['total_rows'] = $this->schedule_model->count_scheduledate($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';

                $data['schedule'] = $this->schedule_model->filterbydate($date,$limit,$offset);
                $this->pagination->initialize($config);

                $this->load->view('refresh',$data);
    }



    function filterbyvenue($offset = NULL) {
         $limit = 10;
       if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
       $date = $this->input->post('venue');

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'schedule/pagevenue/'.$date.'';
            $config['total_rows'] = $this->schedule_model->count_schedulevenue($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


       $data['schedule'] = $this->schedule_model->filterbyvenue($date,$limit,$offset);
       $this->pagination->initialize($config);
       $this->load->view('refresh',$data);
    }


    public function pagevenue($offset = NULL) {

            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
            $date = $this->uri->segment(3);

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'schedule/pagevenue/'.$date.'';
            $config['total_rows'] = $this->schedule_model->count_schedulevenue($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';

                $data['schedule'] = $this->schedule_model->filterbyvenue($date,$limit,$offset);
                $this->pagination->initialize($config);
                $this->load->view('refresh',$data);
    }





}


?>