<?php 
include('../session.php');


require_once("../class.user.php");
 $timeZone = 'Asia/Manila';
date_default_timezone_set( $timeZone);
  
$auth_user = new USER();
$page_level = 2;
$auth_user->check_accesslevel($page_level);
if($auth_user->admin_level() ){
  $pageTitle = "Manage Account";
}
else{
  $pageTitle = "Attendance";
}

?>
<!doctype html>
<html lang="en">
  <head>
    <?php 
      include('x-meta.php');
    ?>


  <?php 
  include('x-css.php');
  ?>
 



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
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
       
        <?php 
        if($auth_user->admin_level() || $auth_user->instructor_level()){
         echo ' <h1 class="h2">Manage Attendance </h1>';
      



        $room_adviser= "";
        $room_section= "";
        $room_academicyear = "";
         if(isset($_REQUEST['room_ID'])){
            $room_ID = $_REQUEST['room_ID'];
            $gar = $auth_user->get_attendance_room($room_ID) ;

              foreach ($gar as $row){
                if($row["suffix"] =="N/A")
                {
                  $suffix = "";
                }
                else
                {
                  $suffix = $row["suffix"];
                }
                if($row["rid_MName"] ==" " || $row["rid_MName"] == NULL || empty($row["rid_MName"]) )
                {
                  $mname = " ";
                }
                else
                {
                  $mname = $row["rid_MName"].'. ';
                }
                  $room_adviser=  $row["rid_FName"].' '.$mname.$row["rid_LName"].' '.$suffix;
                  $room_section= $row["section_Name"];
                  $room_ystr = $row["sem_start"];
                  $room_yend = $row["sem_end"];
                  $room_academicyear = $row["semyear"];
                  $room_gradelevel = $row["yl_Name"];

             }
         }
         
         if(isset($_REQUEST['date'])){
           $selectedDate = $_REQUEST['date'];

         }
         else{
          $selectedDate = date("m/d/Y", time());
         }
        
      

        }
        else{
          echo ' <h1 class="h2">My Attendance</h1>';
        }
        ?>
        
      </div>
      <div class="table-responsive">
        
    <div class="container">
      <div class="card ">
  <div class="card-header text-center">
    <h5><?php echo ucfirst($room_section)?></h5>
  </div>
  <div class="card-body">
    <div class='row'>
      <div class="col-sm-12">
     
        <strong>Academic Year: </strong>(<?php echo $room_academicyear?>)
      </div>
       <div class="col-sm-12">
        <strong>Adviser: </strong><?php echo $room_adviser?>
      </div>
      <?php if($auth_user->instructor_level()) { ?>
      <div class="col-sm-12">
         <strong>Grade Level: </strong><?php echo $room_gradelevel?>
        <!-- <button class="btn btn-secondary btn-sm " data-toggle="modal" data-target="#studentlist_modal">Student List</button> -->
      </div>
      <?php }?>
      
 

    </div>
  </div>
  <div class="card-footer  ">
     <label  ><strong>Date :</strong> <span id="newd"><?php echo $selectedDate;?></span> <input type="hidden" class="form-control restricting" name="date_pick" id="date_pick" placeholder=""  disabled ></label>
  </div>
</div>

        
  <form method="post" id="attendance_form" enctype="multipart/form-data">
<!-- id="roomstudent_data_atnd" -->
    <table class="table table-bordered" >
      <thead>
        
        <tr>
            <th>Roll No.</th>
            <th >LRN</th>
            <th>Student Name</th>
            <th>Sex</th>
            <th>Present/Absent</th>
        </tr>
      </thead>
      <tbody id="roomstudent_data_atndx" >
        
      </tbody>
      
    </table>
     
      <div class="float-right">

        <input type="hidden" name="room_ID" id="room_ID" value="<?php echo $room_ID?>">
        <input type="hidden" name="this_day" id="this_day" value="<?php
       
         echo $selectedDate;
         ?>">
        <input type="hidden" name="operation" id="operation" value="submit_attendance">
        <button type="submit" class="btn btn-primary submit" id="submit_input" value="submit_attendance">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
     
       </form>

 


</div>



<div style="visibility:hidden" id="temp_active_yr"><?php echo $room_ystr?></div>

    </main>
  </div>
</div>

<?php 
include('x-script.php');
?>


  <link rel="stylesheet" href="../assets/plugins/datepicker/jquery-ui.css">
  <link rel="stylesheet" href="../assets/plugins/datepicker/style.css">
  <script src="../assets/plugins/datepicker/jquery-ui.js"></script>
 
        <script type="text/javascript">

      $.ajax({
            url:"s.php",
            method:'POST',
            data:{operation:"fetch_modal_content",room_ID:<?php echo $room_ID?>,selectedDate:"<?php echo $selectedDate?>"},
            dataType    :   'json',
            success:function(data)
            {

             
              $('#roomstudent_data_atndx').html(data.html1);

              $('#operation').val(data.operation);
              $('#operation').text(data.txt);
             
              if (data.txt == "Empty"){
                 $('#submit_input').text(data.txt);
                  $('#submit_input').hide();
              }
              else{
                 $('#submit_input').text(data.txt);
                  $('#submit_input').show();
              }
              $('#h_a_id').html(data.txt1);

              
            }
          });
   
          $(document).ready(function() {

          $.datepicker.setDefaults({
            showOn: "both",
            buttonImageOnly: true,
            buttonImage: "../assets/img/calendar.png",
            buttonText: "Calendar"
          });
          $( "#date_pick" ).datepicker({
            changeMonth: true,
            changeYear: false,
            // minDate:"-5M ",
            maxDate: "0M ",
            
             onSelect: function (date) {
              
              // $( "#this_day" ).val(date);
              $( "#newd" ).html(date);
              window.location.assign("attendance?room_ID=<?php echo $room_ID ?>&date="+date);

             }
              });

          $( "#date_pick" ).datepicker( "setDate", "<?php echo date("m/d/Y", time());?>");

                 var dataTable1 = $('#roomstudent_data_atnd').DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "bAutoWidth": false,
                "searching": false,
                "paging":   false,
                "ordering": false,
                "info":     false,
                "ajax":{
                  url:"datatable/attendance/fetch_student.php?room_ID=<?php echo $room_ID ?>&selectedDate=<?php echo "$selectedDate"?>",
                  type:"POST"
                },
                "columnDefs":[
                  {
                    "targets":[0],
                    "orderable":false,
                  },
                ],

              });

            $(document).on('submit', '#attendance_form', function(event){
            event.preventDefault();
          
              $.ajax({
                url:"datatable/attendance/insert.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                  
                  $('#operation').val("update_attendance");
                  $('#operation').text("Update");
                  $('#submit_input').text("Update");
                  if ($('#operation').val() == "update_attendance")
                  {
                    alert("Successfully Updated");
                  }
                  else{

                    alert("Successfully Submitted");
                  }
                }
              });
           
          });

            
             
           
          } );







        </script>
        </body>

</html>
