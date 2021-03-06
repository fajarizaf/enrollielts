<script type="text/javascript" src="<?php echo base_url();?>assets/js/post-register-candidate.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".select").selecter();



         $('.box-list-country').slimScroll({
             width: '534px',
             height:'300px'
         });

         $('.box-list-language').slimScroll({
             width: '534px',
             height:'300px'
         });

         $('.box-list-question').slimScroll({
             width: '534px',
             height:'300px'
         });

         $('.box-list-level').slimScroll({
             width: '534px',
             height:'300px'
         });

         $('.box-list-sector').slimScroll({
             width: '534px',
             height:'300px'
         });



         $('.selecboxstyle').click(function() {
                  $(this).attr('selection','active');
                });

                $('.specialneeds').click(function() {
                    var specialneeds = $(this).val();
                      if(specialneeds == 'YES') {
                        $('.listspecialneeds').fadeIn('slow');
                        $('.specialneedsdesc').val('');
                        $('.notes').val(''); 
                        $('.specialneedsdesc').focus();
                      } else {
                        $('.listspecialneeds').fadeOut('slow');
                        $('.notes').val('-');
                        $('.specialneedsdesc').val('-');
                      }
                });


                $( "#date_of_birth" ).datepicker({
                    showOn: "button",
                    buttonImage: "<?php echo base_url(); ?>assets/pic/calendar.jpg",
                    buttonImageOnly: true,
                    dateFormat: "yy-m-d",

                  }); 

                $('#country_applying').change(function() {
                    $('#country_applying').valid();
                });
                
                $('#many_years').change(function() {
                    $('#many_years').valid();
                });

                $('.gender').change(function() {
                    if($(this).is(':checked')) {
                        $('.gender').valid();
                    }
                });

                $('.identity').change(function() {
                    if($(this).is(':checked')) {
                        $('.identity').valid();
                    }
                });

                $('#level_of_education').change(function() {
                    $('#level_of_education').valid();
                });

    
     });   

</script>

<style type="text/css">
  
input[type=text] {
  font-family: 'calibri';
  color:#666;
  font-size: 14px;
}

.selecboxstyle {
   font-family: 'calibri';
  color:#666;
  font-size: 14px;
}

</style>

 <div class="register-new-account">
                
                <div class="h3" style="margin-bottom:20px;">Basic Info</div>


        <?php foreach ($datausers as $row) { ?>

            <?php $atributes = array ('id' => 'myformRegisterlogin'); ?> 
            <?php echo form_open_multipart ('member/proses_register', $atributes); ?>

                <table class="table table-striped">

                  <tr>
                    <td>Last Name (family name/surname)*</td>
                    <td style="width:5px;">:</td>
                    <td><?php echo $row->userfamilyname ?></td>
                  </tr>

                  <tr>
                    <td>First (given) name(s)*</td>
                    <td>:</td>
                    <td><?php echo $row->userfirstname ?></td>
                  </tr>

                  <tr>
                    <td>User Gender*</td>
                    <td>:</td>
                    <td>
                      <?php if($row->usergender == 'M' ) { echo 'Male'; } else { echo 'Female'; } ?>
                    </td>
                  </tr>

                  <tr>
                    <td>Phone Number*</td>
                    <td>:</td>
                    <td><?php echo $row->userphone ?></td>
                  </tr>

                  <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td ><?php echo $row->useraddr1 ?></td>
                  </tr>

                  <tr>
                    <td>City*</td>
                    <td>:</td>
                    <td ><?php echo $row->useraddr3 ?></td>
                  </tr>
                  <tr>
                    <td>Zipcode*</td>
                    <td>:</td>
                    <td ><?php echo $row->useraddr4 ?></td>
                  </tr>
                  <tr>
                    <td>Country or region*</td>
                    <td>:</td>
                    <td >
                       <?php echo $row->useraddr2 ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Date Of Birth*</td>
                    <td>:</td>
                    <td ><?php echo $row->userdob ?></td>
                  </tr>


                  <tr>
                    <td><div class="h3" style="margin-top:20px;margin-bottom:20px;">Detail Info</div></td>
                    <td></td>
                    <td ></td>
                  </tr>
                

                  <tr>
                    <td style="width:300px;">Identity Document</td>
                    <td></td>
                    <td style="width:500px;">
                      <input type="radio" style="float:left;" class="identity" name="identity" value="passport" style="float:left;"><div style="float:left;width:100px;margin-left:10px;">Passport</div>
                      <input type="radio" style="float:left;" class="identity" name="identity" value="nic" ><div style="float:left;width:150px;margin-left:10px;">Number Identity Card</div>
                    </td>
                  </tr>
                  <tr>
                    <td>Pasport/NIC Number*</td>
                    <td>:</td>
                    <td><input type="text" id="number_identity" name="number_identity"></td>
                  </tr>
                  <tr>
                    <td>Country of Nationality *</td>
                    <td>:</td>
                    <td>
                      <div href="#listcity" data-toggle="modal" id="countryorigin" class="selecboxstyle"></div>
                      <input type="hidden" id="country_origin" name="country_origin">
                      <input type="text" name="codecountryorigin" class="codecountryorigin">  
                    </td>
                  </tr>
                  <tr>
                    <td>First Language*</td>
                    <td>:</td>
                    <td>
                       <div href="#listlanguage" data-toggle="modal" id="namelanguage" class="selecboxstyle"></div>
                       <input type="hidden" id="language" name="language">
                       <input type="text" name="codelang" class="codelang">
                    </td>
                  </tr>
                  <tr>
                    <td>Occupation (sector)*</td>
                    <td>:</td>
                    <td>
                       <div href="#sector" data-toggle="modal" id="namesector" class="selecboxstyle"></div>
                       <input type="hidden" id="sectors" name="sectors">
                       <input type="text" name="codesector" class="codesector">
                    </td>
                  </tr>
                  <tr class="sector_other">
                    <td style="background:#fff5d4;color:#D37700;border:none;">If other please specify**</td>
                    <td style="background:#fff5d4;border:none;color:#D37700;">:</td>
                    <td style="background:#fff5d4;border:none;"><input style="border-color:orange" type="text" id="sector_other" name="sector_other"></td>
                  </tr>
                  <tr>
                    <td>Occupation (level)*</td>
                    <td>:</td>
                    <td>
                       <div href="#levels" data-toggle="modal" id="namelevel" class="selecboxstyle"></div>
                       <input type="hidden" id="levelss" name="level">
                       <input type="text" name="codelevel" class="codelevel">
                    </td>
                  </tr>
                  <tr class="level_other">
                    <td style="background:#fff5d4;color:#D37700;border:none;" >If other please specify**</td>
                    <td style="background:#fff5d4;border:none;color:#D37700;">:</td>
                    <td style="background:#fff5d4;border:none;"><input style="border-color:orange" type="text" id="level_other" name="level_other"></td>
                  </tr>
                  <tr>
                    <td>Why are you taking the test?*</td>
                    <td>:</td>
                    <td>
                      <div href="#question" data-toggle="modal" id="namequestion" class="selecboxstyle"></div>
                       <input type="hidden" id="taking_test" name="taking_test">
                       <input type="text" name="codequestion" class="codequestion">
                    </td>
                  </tr>
                  <tr class="question_other">
                    <td  style="background:#fff5d4;color:#D37700;border:none;">If other please specify**</td>
                    <td  style="background:#fff5d4;color:#D37700;border:none;">:</td>
                    <td  style="background:#fff5d4;color:orangered;border:none;"><input type="text" id="other_taking_test" name="other_taking_test"></td>
                  </tr>
                  <tr>
                    <td>Which country are you applying/intending to go to?*</td>
                    <td>:</td>
                    <td>
                      <select class="select" name="country_applying" id="country_applying">
                                                            <option value="">Select</option>
                                                            <option value="AUS">Australia</option>
                                                            <option value="CAN">Canada</option>
                                                            <option value="NZ">New Zealand</option>
                                                            <option value="EIR">Republic of Ireland</option>
                                                            <option value="UK">United Kingdom</option>
                                                            <option value="USA">United States of America</option>
                                                            <option value="000">Other</option>
                    </select>
                    </td>
                  </tr>
                  <tr class="other_applying">
                    <td style="color:#D37700;border:none;">If other please specify**</td>
                    <td>:</td>
                    <td><input type="text" id="other_country_applying" name="other_country_applying"></td>
                  </tr>
                  <tr>
                    <td>Where are you currently studying English (if applicable)?</td>
                    <td>:</td>
                    <td><input type="text" id="studying_English" name="studying_English"></td>
                  </tr>
                  <tr>
                    <td>What level of education have you completed?*</td>
                    <td>:</td>
                    <td>
                    <select class="select" name="level_of_education" id="level_of_education">
                                                            <option value="">Select</option>
                                                            <option value="0">Secondary up to 16 years</option>
                                                            <option value="1">Secondary 16 to 19 years</option>
                                                            <option value="2">Degree or equivalent</option>
                                                            <option value="3">Post graduate</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td>How many years have you been studying English?*</td>
                    <td>:</td>
                    <td>
                      <select class="select" name="many_years" id="many_years">
                                                                <option value="">Select</option>
                                                                <option value="Less than 1 year">Less than 1 year</option>
                                                                <option value="2 years">2 years</option>
                                                                <option value="3 years">3 years</option>
                                                                <option value="4 years">4 years</option>
                                                                <option value="5 years">5 years</option>
                                                                <option value="6 years">6 years</option>
                                                                <option value="7 years">7 years</option>
                                                                <option value="8 years">8 years</option>
                                                                <option value="9 years or more">9 years or more</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Do you have any special needs due to ill health/medical conditions?*</td>
                    <td>:</td>
                    <td >
                      <input type="radio" class="specialneeds" name="specialneeds" value="YES" style="float:left;"><div style="float:left;width:20px;margin-left:10px;" class="label label-warning">YES</div>
                      <input type="radio" checked class="specialneeds" name="specialneeds" value="NO" style="float:left;margin-left:10px;" ><div style="float:left;width:20px;margin-left:10px;" class="label label-warning">NO</div>
                    </td>
                  </tr>
                  <tr class="listspecialneeds">
                    <td style="background:#f9edbe;border-color:#f9edbe;color:orange;" colspan="3">If yes, please specify your requirements below. You must attach supporting medical evidence to this form. Requests for modified test materials must be submitted at least 3 months before the test.</td>
                  </tr>
                  <tr  class="listspecialneeds">
                    <td style="background:#f9edbe;border-color:#f9edbe;color:orangered;" colspan="3">
                    <p>Please Specify**</p>
                    <textarea style="width:100%;-moz-border-radius:2px 2px 2px;-webkit-border-radius:2px 2px 2px;border-radius:2px 2px 2px" class="specialneedsdesc" name="specialneedsdesc"></textarea></td>
                  </tr>
                  <tr  class="listspecialneeds">
                  <td style="background:#f9edbe;border-color:#f9edbe;" colspan="3">
                    <p>Notes**</p>
                    <textarea style="height:40px;width:100%;-moz-border-radius:2px 2px 2px;-webkit-border-radius:2px 2px 2px;border-radius:2px 2px 2px" class="notes" name="notes"></textarea></td>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" name="Register" id="SubmitRegister" style="float:right;width:200px;" class="btn btn-warning"  value="Continue"></td>
                  </tr>

                <table>
            <?php echo form_close(); ?>
          <?php } ?>
       

                </div>




  <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script> 
        <script>

              jQuery.validator.setDefaults({
              ignore: '',
              success: "valid",
              submitHandler: function(form) { 
                

                 $('#parentloading').fadeIn('slow'); 
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                             var idschedules = $('input[name=date-test]:checked').val();


                             var counter=2;
                              var countdown = setInterval(function(){
                                if (counter == 0) {
                                clearInterval(countdown);
                                

                                  if($('input[name=date-test]').is(':checked')) {
                                      $.ajax({
                                      type  : "POST",
                                      url: ""+base_url+"register/proses_register/"+idschedules+"",
                                      data: $("#myformRegisterlogin").serialize(),
                                      dataType: "json",
                                      success : function(response){
                                        $('#parentloading').fadeOut('slow');
                                               $('#btn-city').attr('class','visited');
                                               $('#btn-date').attr('class','visited');
                                               $('#btn-tos').attr('class','visited');
                                               $('#btn-tos').attr('class','visited');
                                               $('#btn-candidate').attr('class','visited');
                                               $('#btn-finish').attr('class','active');

                                              var testvenue = $('.displaylocation').html();

                                              $.each( response , function(key,val) {

                                                $('.result-Test-date').html(val.testdate);
                                                $('.result-Test-venue').html(testvenue);
                                                $('.result-Test-module').html(val.module);
                                                $('.idr').html(val.rupiah);
                                                $('.dollar').html(val.dollar);
                                                $('.gbp').html(val.gbp);



                                                  if( val.status == 'success') {
                                                       $('.box-results').html('<b class="font1" style="color:#802222;">Register successful.</b>  <span style="color:#e44b00;"> -  Your registration was successful. Here are the details:</span>');
                                                       $('.content-tab').animate({ scrollLeft:'3840px' });
                                                       $('#sticky').sticky('<span style="color:#802222;">Register successful.</span>');
                                                       $('.box-tab ul li').attr('action','disabled');
                                                    } else {
                                                       $('.box-results').html('<b class="font1" style="color:#802222;">Already registered.</b>&nbsp; <span style="color:#e44b00;">- Your registration was successful. Here are the details:</span>');
                                                       $('.content-tab').animate({ scrollLeft:'3840px' });
                                                       $('#sticky').sticky('<span style="color:#802222;">Already registered.</span>');
                                                       $('.box-tab ul li').attr('action','disabled');
                                                  }

                                                  
                                                   
                                              });

                                           

                                          }
                                      });

                                    } else {
                                      $('#sticky').sticky('<span style="color:#802222;">date of the test must be selected</span>');
                                  }

                            }
                              counter--;
                            }, 500);

              }
            });


            $( "#myformRegisterlogin" ).validate({
              rules: {
                username: {
                  required: true
                },
                last_name: {
                  required: true
                },
                first_name: {
                  required: true
                },
                gender: {
                  required: true
                },
                phone_number: {
                  required: true,
                  number: true
                },
                address: {
                  required: true
                },
                city: {
                  required: true
                },
                zipcode: {
                  required: true,
                  number: true
                },
                codecity: {
                  required: true
                },
                date_of_birth: {
                  required: true
                },
                identity: {
                  required: true
                },
                number_identity: {
                  required: true
                },
                codecountryorigin: {
                  required: true
                },
                codelang: {
                  required: true
                },
                codesector: {
                  required: true
                },
                codelevel: {
                  required: true
                },
                codequestion: {
                  required: true
                },
                country_applying: {
                  required: true
                },
                studying_English: {
                  required: true
                },
                level_of_education: {
                  required: true
                },
                many_years: {
                  required: true
                }
              }

              
              
              
            });

        </script>
