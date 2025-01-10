<?php 
include('../session.php');


require_once("../class.user.php");

$GLOBALS['x_final'] = 0;
$GLOBALS['x_finalc'] = 0;

$auth_user = new USER();
// $page_level = 3;
// $auth_user->check_accesslevel($page_level);
$pageTitle = "Dashboard";
?>
<!doctype html>
<html lang="en">
  <head>
    <?php 
      include('x-meta.php');
    ?>


    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../assets/css/icomoon/styles.css" rel="stylesheet" type="text/css">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
<?php 
include('x-nav.php');
?>

<div class="container-fluid">
  <div class="row">
    <?php 
    include('x-sidenav.php');
    ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
     <!--    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Dashboard</h1> 
      </div>-->

    <div class="row">
                <div class="col-sm-12 text-center " style="min-height: 100px;">
                     <img src="../assets/img/logo/logo1.png" height="80" style="margin-left: -600px;"> <H3 style="margin-top: -50px;">STO. NIÑO NATIONAL HIGH SCHOOL<br>MAIN CAMPUS</H3>
                </div>
            </div>
            <div class="row" >
              <?php if($auth_user->admin_level() ){ ?>
              <div class="col-6 col-sm-6" style="padding-bottom:5px;">
                <div class="card ">
                  <div class="card-header text-center" style=" border-bottom: 5px solid ;">
                   <strong>MISSION</strong>
                  </div>
                  <div class="card-body text-center"  style="min-height: 250px">
                  To protect and promote the right of every Filipino to quality, equitably, culture-based, and complete basic education where:

*Students learn in a child-friendly, gender-sensitive, safe and motivating environment

*Techers facilitate learning and constantly nurture every learner

*Administrators and staff, as stewards of the institution, ensure an enabling and supportive environment for effective learning to happen.

*Family, Community, and other stakeholders are actively engaged and share responsibility for developing life-long learners.
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-6" style="padding-bottom:5px;">
                <div class="card ">
                  <div class="card-header text-center" style=" border-bottom: 5px solid ;">
                    <strong>VISION</strong>
                  </div>
                  <div class="card-body text-center"  style="min-height: 250px">
                  We Dream of Filipinos who passionately love their country and whose values and competencies enaable them to realize their full potential and contribute meaningfully to building the nation.

As a learner-centered public institutuion, the Department of Education continuously improves itself to better serve its stakeholders.

                  </div>
                </div>
              </div>
              <?php } ?>
              <?php  if($auth_user->student_level()) { ?>
              <div class="col-12 col-sm-12" style="padding-bottom:5px;">
                <div class="card ">
                  <div class="card-header bg-primary text-white" style=" border-bottom: 5px solid #adb5bd ;">
                    <strong>Basic Information</strong>
                  </div>
                  <div class="card-body "  style="min-height: 250px">
                    <div class="row">
                      <div class="col-lg-4">
                        <img src="<?php $auth_user->getUserPic();?>"  height="125" width="125"  class="rounded-circle"  style="border:1px solid; border-color: #4caf50;">
                      </div>

                      <div class="col-lg-8">
                        <h3><b>Name:</b> <?php  $auth_user->profile_name()?> </h3>
                        <h3><b>LRN:</b> <?php  $auth_user->profile_school_id()?></h3>
                        <h3><b>Sex:</b> <?php  $auth_user->profile_sex()?></h3>
                        
                      </div>
                    </div>

                  </div>
                </div>
              </div>

               <div class="col-12 col-sm-12" style="padding-bottom:5px;">
                <div class="card ">
                  <div class="card-header bg-primary text-center text-white" style=" border-bottom: 5px solid #adb5bd ;">
                    <strong>Access your information quickly</strong>
                  </div>
                  <div class="card-body text-center"  style="min-height: 250px">
                    <div class="row">
                    <div class="col-lg-<?php
                      if($auth_user->student_level()){
                        echo "6";
                      }
                      else{
                        echo "4";
                      }
                    ?> text-center">
                      <i class="icon-book" style="font-size: 100px;" data-toggle="modal" data-target="#enrolled_subject"></i>
                      <span data-feather="user" data-toggle="modal" data-target="#enrolled_subject"></span>
                      <br>
                      <h3>Enrolled Subject</h3>
                    </div>
                    <div class="col-lg-<?php
                      if($auth_user->student_level()){
                        echo "6";
                      }
                      else{
                        echo "4";
                      }
                    ?> text-center">
                      <i class="icon-clipboard" style="font-size: 100px;" data-toggle="modal" data-target="#enrolled_subject_grade"></i>
                      <br>
                      <h3>Latest Grade</h3>
                    </div>
                   
                  </div>

                  </div>
                </div>
              </div>
              <?php } ?>
              
              <?php  if($auth_user->instructor_level() ) { ?>
              <!-- INSTRUCTOR -->
            
                 <div class="col-12 col-sm-12" style="padding-bottom:5px;">
                <div class="card ">
                  <div class="card-header bg-primary text-white" style=" border-bottom: 5px solid #adb5bd ;">
                    <strong>Basic Information</strong>
                  </div>
                  <div class="card-body "  style="min-height: 250px">
                    <div class="row">
                      <div class="col-lg-4">
                        <img src="<?php $auth_user->getUserPic();?>"  height="125" width="125"  class="rounded-circle"  style="border:1px solid; border-color: #4caf50;">
                      </div>

                      <div class="col-lg-8">
                        <h3><b>Name:</b> <?php  $auth_user->profile_name()?> </h3>
                        <h3><b>Goverment ID:</b> <?php  $auth_user->profile_school_id()?></h3>
                        <h3><b>Sex:</b> <?php  $auth_user->profile_sex()?></h3>
                        
                      </div>
                    </div>

                  </div>
                </div>
              </div>

                   <div class="col-12 col-sm-12" style="padding-bottom:5px;">
                <div class="card ">
                  <div class="card-header bg-primary text-center text-white" style=" border-bottom: 5px solid #adb5bd ;">
                    <strong>Access your information quickly</strong>
                  </div>
                  <div class="card-body text-center"  style="min-height: 250px">
                    <div class="row">
                    <div class="col-lg-6 text-center">
                      <i class="icon-book" style="font-size: 100px;" data-toggle="modal" data-target="#advisory_section"></i>
                      <span data-feather="user" data-toggle="modal" data-target="#advisory_section"></span>
                      <br>
                      <h3>Advisory Section</h3>
                    </div>
                    <div class="col-lg-6 text-center">
                      <i class="icon-clipboard" style="font-size: 100px;" data-toggle="modal" data-target="#handle_section"></i>
                      <br>
                      <h3>Handle Section</h3>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
              <?php } ?>

            </div>

<!-- Modal -->
<div class="modal fade" id="enrolled_subject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enrolled Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <div class="accordion" id="accordionExample">
      <?php 
      $auth_user->get_enrolled();
      ?>

    </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>









<!-- Modal -->
<div class="modal fade" id="enrolled_subject_grade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Latest Grade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered ">
      <thead>
        <tr class="bg-primary text-white">
          <th>Schedule Code</th>
      <th>Description</th>
      <th>First</th>
      <th>Second</th>
      <th>Third</th>
      <th>Fourth</th>
      <th>Total</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      $auth_user->get_latest_grade();
      ?>

        <tr> 
            <td colspan="6"><strong>TOTAL GPA:</strong></td>
            <td><?php
            if(isset($GLOBALS['x_final'])) {
              echo number_format($GLOBALS['x_final']/$GLOBALS['x_finalc'],2);
            }
             
            


            ?></td>
        </tr>
      </tbody>
    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
















<!-- Modal -->
<div class="modal fade" id="attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attendance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>













<!-- Modal -->
<div class="modal fade" id="advisory_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Advisory Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php 
       $asdvs = $auth_user->get_sem_advisory_section();
      
       ?>

        <div class="accordion" id="accordionSectionAdvisory" >
          <?php 
          $sa_i = 1;
           foreach ($asdvs as $row){

              ?>
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo  $sa_i?>" aria-expanded="true" aria-controls="collapseOne">
                      School Year: <?php echo  $row["semyear"]?>
                    </button>
                  </h5>
                </div>

                <div id="collapse<?php echo  $sa_i?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionSectionAdvisory">
                  <div class="card-body"  style="min-height: 450px;">
                   <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th>#</th>
                        <th>Section</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $sa_o = 1;
                      $advs = $auth_user->get_advisory_section($row["rid_ID"],$row["sem_ID"]);
                       foreach ($advs as $row1){

                          ?>
                            <tr>
                              <td><?php echo $sa_o;?></td>
                              <td width="70%"><?php echo $row1["section_Name"];?></td>
                              <td>
                                  <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item " id="printstud_modalx" data-id="<?php echo $row1["room_ID"];?>">Print Student list</a>
                                      <a class="dropdown-item view_student_in_this_room_advisory"  id="<?php echo $row1["room_ID"];?>">View Student</a>
                                      <a class="dropdown-item view_attendance_in_this_room" href="attendance?room_ID=<?php echo $row1["room_ID"];?>">View Attendance</a>
                                      
                                    </div>
                                  </div>
                              </td>
                            </tr>
                          <?php
                         $sa_o++;
                       }
                    ?>
                      </tbody>
                  </table>
                  <br>
                  <br>
                  <br>
                  </div>
                </div>
              </div>
              <?php
              $sa_i++;
           }
          ?>

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="handle_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Handle Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
         $ash = $auth_user->get_sem_handle();
        
         ?>
          <div class="accordion" id="accordionSectionHandle">
          <?php 
           $sa_ii = 1;
           foreach ($ash as $row){
                ?>
              <div class="card">
                <div class="card-header" id="heading<?php echo  $sa_ii?>">
                  <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_B_<?php echo  $sa_ii?>" aria-expanded="true" aria-controls="collapse_B_<?php echo  $sa_ii?>">
                      School Year: <?php echo  $row["semyear"]?>
                    </button>
                  </h5>
                </div>

                <div id="collapse_B_<?php echo  $sa_ii?>" class="collapse show" aria-labelledby="heading_B_<?php echo  $sa_ii?>" data-parent="#accordionSectionHandle">
                  <div class="card-body">
                   <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th>#</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sa_oo = 1;
                      $ashs = $auth_user->get_sem_handle_section($row["sem_ID"]);
                      foreach ($ashs as $row1){
                        $rsub_ID =$row1["rsub_ID"];
                        $room_ID =$row1["room_ID"];
                          ?>
                            <tr>
                              <td><?php echo $sa_oo;?></td>
                              <td width="70%"><?php echo $row1["section_Name"];?></td>
                              <td width="70%"><?php echo $row1["subject_Title"];?></td>
                              <td>
                                  <div class="dropleft ">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                       <a class="dropdown-item " id="printstud_handle_sec" data-id="<?php echo $row1["room_ID"];?>">Print Student list</a>
                                      <a class="dropdown-item view_student_in_this_room_handle"  data-id="<?php echo $rsub_ID?>" id="<?php echo $room_ID;?>">View Student</a>
                                       
                                    </div>
                                  </div>
                              </td>
                            </tr>
                          <?php
                         $sa_oo++;
                      }
                      ?>
                    </tbody>
                  </table>
                  <br>
                  </div>
                </div>
              </div>
              <?php
              $sa_ii++;

           }?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>







<!-- Modal -->
<div class="modal fade" id="room_Student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title " id="exampleModalLabel">List of Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="min-height: 450px">
       <table class=" table table-bordered" id="roomstudent_data">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">LRN</th>
            <th scope="col">Full Name</th>
            <th scope="col">Sex</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="grade_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Grade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" id="grading_form" enctype="multipart/form-data">
      <div class="modal-body">
       
        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="grading_first">First</label>
            <input type="text" class="form-control gradeinput sxgrading gf1" id="grading_first" maxlength="5" name="grading_first" placeholder="Grading" value="" maxlength="5" onkeyup="numberInputOnly(this);">
            
            <!-- <input class=" form-control sxgrading gradeinput" type="number" min="65" max="100" step=".01" value="" /> -->


          </div>
          <div class="form-group col-md-2">
            <label for="grading_second">Second</label>
            <input type="text" class="form-control gradeinput sxgrading gf2" id="grading_second" maxlength="5" name="grading_second" value="" maxlength="5" onkeyup="numberInputOnly(this);">
          </div>
          <div class="form-group col-md-2">
            <label for="grading_third">Third</label>
            <input type="text" class="form-control gradeinput sxgrading gf3" id="grading_third" maxlength="5" name="grading_third"  value="" maxlength="5" onkeyup="numberInputOnly(this);">
          </div>
          <div class="form-group col-md-2">
            <label for="grading_fourth">Fourth</label>
            <input type="text" class="form-control gradeinput sxgrading gf4" id="grading_fourth" maxlength="5" name="grading_fourth" value="" maxlength="5" onkeyup="numberInputOnly(this);">
          </div>

          <div class="form-group col-md-4">
            <label for="grading_final">Final</label>
            <input type="text" class="form-control" id="grading_final" maxlength="5" name="grading_final" placeholder="Grading" value="" maxlength="5" onkeyup="numberInputOnly(this);" disabled>
          </div>
          <div class="form-group col-md-12">
            <label for="grading_remark">Remark</label>
            <input type="text" class="form-control" id="grading_remark" maxlength="25" name="grading_remark" placeholder="" value="" disabled >
          </div>
        </div>

        <input type="hidden" id="res_ID" name="res_ID">
        <input type="hidden" id="rsg_ID" name="rsg_ID">
        <input type="hidden" id="rsub_ID" name="rsub_ID">
        <input type="hidden" id="grading_remarkx" name="grading_remarkx">
        <input type="hidden" id="final_grade_daw" name="final_grade_daw">

       
      </div>
      <div class="modal-footer "  >
        <input type="hidden" id="operation" name="operation">
        <button type="submit" class="btn btn-primary submit" id="submit_grading" name="submit_grading"  value="submit_grading">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
       </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="print_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Print Student List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe id="print_frame" src="#" style="width:100%; height:800px;" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>







    </main>
  </div>
</div>
<?php 
include('x-script.php');

?>

        <script>
             //NUMBER ONLY
  function numberInputOnly(elem) {
                var validChars = /[0-9.]/;
                var strIn = elem.value;
                var strOut = '';
                for(var i=0; i < strIn.length; i++) {
                  strOut += (validChars.test(strIn.charAt(i)))? strIn.charAt(i) : '';
                }
                elem.value = strOut;
            }
  //LETTER ONLY
   function letterInputOnly(elem) {
                var validChars = /[a-zA-ZñÑ .]+/;
                var strIn = elem.value;
                var strOut = '';
                for(var i=0; i < strIn.length; i++) {
                  strOut += (validChars.test(strIn.charAt(i)))? strIn.charAt(i) : '';
                }
                elem.value = strOut;
            }
          function goto_attendance(){

            window.location.assign('attendance');
          }
           function goto_attendance1($room_ID){
         
            window.location.assign('attendance1?room_ID='+$room_ID);
          }
          $(document).ready(function() {
             
            function roomstudent(rx_ID,rsub_ID,type){
              if (type == "handle"){
                var url_data = "datatable/index/fetch.php?room_ID="+rx_ID+"&rsub_ID="+rsub_ID+"&handle_sec=1";
              }
              else{
                var url_data = "datatable/index/fetch.php?room_ID="+rx_ID+"&rsub_ID="+rsub_ID;
              }
              var dataTable = $('#roomstudent_data').DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "bAutoWidth": false,
                "searching": false,
                "paging":   false,
                "ordering": false,
                "info":     false,
                "ajax":{
                  url:url_data,
                  type:"POST"
                },
                "columnDefs":[
                  {
                    "targets":[0],
                    "orderable":false,
                  },
                ],

              });

              if (type == "advisory"){
                dataTable.columns( [4] ).visible( false );
              }
            }
         




          $(document).on('click', '.view_student_in_this_room', function(){
            var room_ID = $(this).attr("id");
            var rsub_ID = $(this).attr("data-id");

          
            $('#room_Student').modal("show");
            $('#roomstudent_data').DataTable().destroy();
              roomstudent(room_ID,rsub_ID,"overall");
          });

          $(document).on('click', '.view_student_in_this_room_handle', function(){
            var room_ID = $(this).attr("id");
            var rsub_ID = $(this).attr("data-id");

          
            $('#room_Student').modal("show");
            $('#roomstudent_data').DataTable().destroy();
              roomstudent(room_ID,rsub_ID,"handle");
          });

          $(document).on('click', '.view_student_in_this_room_advisory', function(){
            var room_ID = $(this).attr("id");
            var rsub_ID = $(this).attr("data-id");

          
            $('#room_Student').modal("show");
            $('#roomstudent_data').DataTable().destroy();
              roomstudent(room_ID,rsub_ID,"advisory");

              
          });

           $(document).on('click', '.grade', function(){
            var res_ID = $(this).attr("id");
            var rsub_ID = $(this).attr("sub-id");
            $('#grade_student').modal("show");


           
            if ( $('#grading_first').val() == "" || $('#grading_first').val() == 0){

             $("#grading_second").prop("disabled", true);
             $("#grading_third").prop("disabled", true);
             $("#grading_fourth").prop("disabled", true);
            }


             $.ajax({
                url:"datatable/index/fetch_single.php",
                method:'POST',
                data:{action:"grading",res_ID:res_ID,rsub_ID:rsub_ID},
                dataType    :   'json',
                success:function(data)
                {
                  $('#grading_first').val(data.grading_first);
                  $('#grading_second').val(data.grading_second);
                  $('#grading_third').val(data.grading_third);
                  $('#grading_fourth').val(data.grading_fourth);
                  $('#grading_final').val(data.grading_final);
                  $('#final_grade_daw').val(data.final_grade_daw);
                  $('#grading_remark').val(data.grading_remark);
                  $('#res_ID').val(res_ID);
                  $('#rsub_ID').val(rsub_ID);
                  $('#rsg_ID').val(data.rsg_ID);
                  $('#operation').val(data.gbtn_z);
                  $('#submit_grading').text(data.gbtn_zt);
                  if(data.grading_first != "")
                  {
                    $("#grading_first").prop("disabled", false);
                  }
                  if(data.grading_second != "")
                  {
                    $("#grading_second").prop("disabled", false);
                  }
                  if(data.grading_third != "")
                  {
                    $("#grading_third").prop("disabled", false);
                  }
                  if(data.grading_fourth != "")
                  {
                    $("#grading_fourth").prop("disabled", false);
                  }

                
                  
                }
              });
          });

         

          $(document).on('submit', '#grading_form', function(event){
            event.preventDefault();

               if(
                $('#grading_first').val() == "" || $('#grading_first').val() == "0" ||
                $('#grading_second').val() == "" || $('#grading_second').val() == "0" ||
                $('#grading_third').val() == "" || $('#grading_third').val() == "0" ||
                $('#grading_fourth').val() == "" || $('#grading_fourth').val() == "0" 
                ){
                alert("Add Student Grade Don't Leave It Blank");
               }
               else{
                  $.ajax({
                  url:"datatable/index/insert.php",
                  method:'POST',
                  data:new FormData(this),
                  contentType:false,
                  processData:false,
                  dataType    :   'json',
                  success:function(data)
                  {
                    $('#grade_student').modal("hide");
                    if(data.success){
                      if(data.op == "grading_update"){
                        alert("Successfully Update");
                      }
                      if(data.op == "grading_submit"){
                        alert("Successfully Added");
                      }
                      
                      $('#grade_student').modal("hide");
                      alertify.alert(data.success).setHeader('Grade');
                    }
                     if(data.error){
                        alert("Error Update");
                        $('#grade_student').modal("hide");

                    }
                   

                  }
                });
               }

        


           
          });

           $(document).on('change', '.sxgrading', function(){
              var grading_first  = 0;
              var grading_second = 0;
              var grading_third  = 0;
              var grading_fourth = 0;
               grading_first  = $('#grading_first').val();
               grading_second = $('#grading_second').val();
               grading_third  = $('#grading_third').val();
               grading_fourth = $('#grading_fourth').val();


              var grading_final =  "("+grading_first+"+"+grading_second+"+"+grading_third+"+"+grading_fourth+")"+"/4";
             
                $('#grading_final').val(eval(grading_final));
                
                 $('#final_grade_daw').val(eval(grading_final));
                var gfx = new Number($('#grading_final').val());
                if (gfx > 75){
                  $('#grading_remark').val("Passed");
                  $('#grading_remarkx').val("Passed");
                  
                }
                else{
                  $('#grading_remark').val("Failed");
                  $('#grading_remarkx').val("Failed");
                }
            });


            $(document).on('click', '#printstud_modalx', function(event){
             var room_ID =  $(this).attr("data-id");

            
             var datastr  = '';
                datastr += 'action=print_studentlist&';
                datastr += 'room_ID=' + room_ID + '';
              // alertify.confirm(
              //   'Are you sure you want to print  student list in this room?', 
              //   function(){ 

              //       $('#print_frame').attr('src', "print.php?"+datastr);
              //       $('#print_modal').modal('show');

              //     alertify.success('Generate Print Success') 
              //   }, 
              //   function(){ 
              //     alertify.error('Cancel')
              //   }).setHeader('Room');

                  if(confirm("Are you sure you want to print  student list in this room?"))
                {
                    $('#print_frame').attr('src', "print.php?"+datastr);
                    $('#print_modal').modal('show');

                  alertify.success('Generate Print Success') 

                }
                else{
                  return false;
                }
             

          });
          $(document).on('click', '#printstud_handle_sec', function(event){
             var room_ID =  $(this).attr("data-id");

            
             var datastr  = '';
                datastr += 'action=print_studentlist&';
                datastr += 'room_ID=' + room_ID + '&handle_sec=1';
              // alertify.confirm(
              //   'Are you sure you want to print  student list in this room?', 
              //   function(){ 

              //       $('#print_frame').attr('src', "print.php?"+datastr);
              //       $('#print_modal').modal('show');

              //     alertify.success('Generate Print Success') 
              //   }, 
              //   function(){ 
              //     alertify.error('Cancel')
              //   }).setHeader('Room');

                  if(confirm("Are you sure you want to print  student list in this room?"))
                {
                    $('#print_frame').attr('src', "print.php?"+datastr);
                    $('#print_modal').modal('show');

                  alertify.success('Generate Print Success') 

                }
                else{
                  return false;
                }
             

          });

        $(".gradeinput").on('keyup keypress blur change', function(e) {

              if($(this).val() > 100){
                $(this).val('100');
                return false;
              }

            });






          });

          $(".gf1").on('keyup keypress blur change', function(e) {
         
             if ($('#grading_first').val() == "" || $('#grading_first').val() == 0)
            {
              
               $("#grading_second").prop("disabled", true);
               $("#grading_third").prop("disabled", true);
               $("#grading_fourth").prop("disabled", true);
            }
            else{

               $("#grading_second").prop("disabled", false);
               $("#grading_third").prop("disabled", true);
               $("#grading_fourth").prop("disabled", true);

            }
                    
          });

          $(".gf2").on('keyup keypress blur change', function(e) {
         
             if ($('#grading_second').val() == "" || $('#grading_second').val() == 0)
            {
              
               $("#grading_third").prop("disabled", true);
               $("#grading_fourth").prop("disabled", true);

               $("#grading_third").val("");
               $("#grading_fourth").val("");
            }
            else{

               $("#grading_third").prop("disabled", false);
               $("#grading_fourth").prop("disabled", true);

            }
                    
          });

          $(".gf3").on('keyup keypress blur change', function(e) {
         
             if ($('#grading_third').val() == "" || $('#grading_third').val() == 0)
            {
              
               $("#grading_fourth").val("");
               $("#grading_fourth").prop("disabled", true);
            }
            else{

               $("#grading_fourth").prop("disabled", false);

            }
                    
          });

        </script>
  
      </body>
</html>
