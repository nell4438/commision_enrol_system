<?php 
include('../session.php');


require_once("../class.user.php");

  
$auth_user = new USER();
// $page_level = 2;
// $auth_user->check_accesslevel($page_level);
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
      
         }
        else{
          echo ' <h1 class="h2">My Attendance</h1>';
        }


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
             }
         }
        
      

        
        ?>
        
      </div>
      <div class="table-responsive">
        
    <div class="container">
      <div class="card text-center">
  <div class="card-header ">
    <h5><?php echo ucfirst($room_section)?></h5>
  </div>
  <div class="card-body">
    <div class='row'>
      <div class="col-sm-4">
     
        <strong>Academic Year:</strong>(<?php echo $room_academicyear?>)
      </div>
       <div class="col-sm-4">
        <strong>Adviser:</strong><?php echo $room_adviser?>
      </div>
      <?php if($auth_user->instructor_level()) { ?>
      <div class="col-sm-4">
        <button class="btn btn-secondary btn-sm " data-toggle="modal" data-target="#studentlist_modal">Student List</button>
      </div>
      <?php }?>
      

    </div>
  </div>
  <div class="card-footer ">
    <div class="float-left">

      <strong>LEGEND:</strong>
      <?php if($auth_user->instructor_level()) { ?>
         ATTENDANCE: <span class="withattendance-append">|</span>
      <?php }?>
       <?php if($auth_user->student_level()) { ?>
          PRESENT: <span class="present-append">|</span>
          ABSENT: <span class="absent-append">|</span>
      <?php }?>
       
    </div>

    <div class="float-right">
      <div class="dropdown">
      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
        Filter year
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <button class="dropdown-item" data-id="<?php echo $room_ystr?>" id="filter_year"><?php echo $room_ystr?></button>
        <button class="dropdown-item" data-id="<?php echo $room_yend?>" id="filter_year"><?php echo $room_yend?></button>
      </div>

    </div>

    </div>

    <?php if($auth_user->student_level()) { ?>

          <div class="text-center">
            <strong>TOTAL:</strong>
            PRESENT: <span id="day_p">()</span>
            ABSENT: <span id="day_a"> ()</span>
          </div>

    <?php }?>
    
  
 


  </div>
</div>
    <link rel="stylesheet" href="../assets/plugins/yearcalendar/jquery.bootstrap.year.calendar.css">
   
    <br>
    <div class="calendar"></div>
 

<div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="product_modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="account_modal_title">Attendance </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="calendar_modal_content">
          
        </div>
        <form method="post" id="attendance_form" enctype="multipart/form-data">
  
             <!--   <a class="dropdown-item"  data-toggle="modal" data-target="#delaccount_modal">try_dual</a> -->
                <div class="form-group col-md-12">
                  <label for="calendar_day"><strong>Date :</strong> <span id="onlick_cday">calendar_day</span> </label>
              
                </div>

      
   
    <!-- <table class="table table-bordered" id="roomstudent_data_atnd"> -->
    <table class="table table-bordered">
      <thead>
        
        <tr>
            <th>Roll No.</th>
            <th >LRN</th>
            <th>Student Name</th>
            <th>Sex</th>
            <th>Present/Absent</th>
        </tr>
      </thead>
      <tbody  id="roomstudent_data_atndx">
        
      </tbody>
      
    </table>
      <div class="modal-footer">
   
        <input type="hidden" name="room_ID" id="room_ID" value="<?php echo $room_ID?>">
        <input type="hidden" name="this_day" id="this_day">
        <input type="hidden" name="operation" id="operation" value="submit_attendance">
        <button type="submit" class="btn btn-primary submit" id="submit_input" value="submit_attendance">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
       </form>

    </div>
  </div>
</div>

</div>
</div>






<!-- Modal -->
<div class="modal fade" id="studentlist_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List of Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding:0px;">
      <table class="table table-bordered" id="roomstudent_data">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">LRN</th>
            <th scope="col">Full Name</th>
            <th scope="col">Sex</th>
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


<div style="visibility:hidden" id="temp_active_yr"><?php echo $room_ystr?></div>

    </main>
  </div>
</div>

<?php 
include('x-script.php');
?>
    <script src="../assets/plugins/yearcalendar/jquery.bootstrap.year.calendar.js"></script>
    <style>
    /*FOR STUDENT ATTENDANCE*/
      .withattendance-append{
          background-color:#dc3545;
          color:#dc3545;
          width:1px !important;
          height:1px !important;
      }
      .absent-append{
          background-color:#dc3545;
          color:#dc3545;
          width:1px !important;
          height:1px !important;
      }
       .present-append{
          background-color:green;
          color:green;
          width:1px !important;
          height:1px !important;
      }
    </style>
    <script>
    day_absent_present(<?php echo $room_ystr?>);
      function day_absent_present(year){
 
         $.ajax({
            url:"s1.php",
            method:'POST',
            data:{operation:"fetch_attcount",room_ID:<?php echo $room_ID?>,date:year},
            dataType    :   'json',
            success:function(data)
            {

              $("#day_a").html(data.absent);
              $("#day_p").html(data.present); 

            }
          });
   
      }
    calendaryo(<?php echo $room_ystr?>);
    function calendaryo(year){
       $('.calendar').calendar({
        startYear: year,
        maxYear: year,
        minYear: year,
      });

   
       

      $('.calendar').on('jqyc.dayChoose', function (event) {
          var choosenYear = $(this).data('year');
          var choosenMonth = $(this).data('month');
          var choosenDay = $(this).data('day-of-month');
          var date = new Date(choosenYear, choosenMonth, choosenDay);
          // 2019-09-18
          var ymd  = choosenYear+'-'+choosenMonth+'-'+choosenDay ;

          var timestamp = date.getMilliseconds();
          console.log(date);
          console.log(ymd);
          
          $('#onlick_cday').val(date);
          $('#onlick_cday').html(date);
          $('#this_day').val(ymd);

          

          $.ajax({
            url:"s.php",
            method:'POST',
            data:{operation:"fetch_modal_content",room_ID:<?php echo $room_ID?>,date:ymd},
            dataType    :   'json',
            success:function(data)
            {

              // $('#calendar_modal_content').html(data.html);
              $('#roomstudent_data_atndx').html(data.html1);

              $('#operation').val(data.operation);
              $('#operation').text(data.txt);
              $('#submit_input').text(data.txt);
              $('#h_a_id').html(data.txt1);

              
            }
          });
           // $('#calendar_modal').modal('show');
           
      });
      function present_thisDay(status,y,m,d){
        console.log(status+"|"+y+"|"+m+"|"+d);
        if (status == "teacher"){
           $('.calendar').calendar('appendText', '|', y, m, d,'withattendance-append');
        }
        else if(status == "absent")
        {
          $('.calendar').calendar('appendText', '|', y, m, d,'absent-append');
        }
        else{
          $('.calendar').calendar('appendText', '|', y, m, d,'present-append');
        }        
      }
           /* FOR STUDENT ATTENDANCE*/
      <?php 
       // present_thisDay('absent',2020, 3, 4);
      // present_thisDay('present',2020, 3, 5);
      ?> 
    
      function remove_zero($z){
        if ($z == "01"){
          $z = 1;
        }
        if ($z == "02"){
          $z = 2;
        }
        if ($z == "03"){
          $z = 3;
        }
        if ($z == "04"){
          $z = 4;
        }
        if ($z == "05"){
          $z = 5;
        }
        if ($z == "06"){
          $z = 6;
        }
        if ($z == "07"){
          $z = 7;
        }
        if ($z == "08"){
          $z = 8;
        }
        if ($z == "09"){
          $z = 9;
        }
        return $z;
      }
         $.ajax({
               url:"test1.php?room_ID=<?php echo $room_ID?>",
                method:'POST',
                data:{action:"student"},
                contentType:false,
                processData:false,
                type:  'json',
                success:function(data)
                {

                  var newdata = JSON.parse(data);
                  for (i = 0; i < newdata.year.length; i++) {
                    present_thisDay(newdata.statx[i],newdata.year[i],remove_zero(newdata.month[i]), remove_zero(newdata.dayz[i]) );
                    
                  }
                }
              });
 



    }




      
      

</script>
        <script type="text/javascript">
   


          $(document).ready(function() {

          
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
                  url:"datatable/attendance/fetch_student.php?room_ID=<?php echo $room_ID ?>",
                  type:"POST"
                },
                "columnDefs":[
                  {
                    "targets":[0],
                    "orderable":false,
                  },
                ],

              });

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
                  url:"datatable/attendance/fetch_student.php?room_ID=<?php echo $room_ID ?>",
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
                  
                  $('#calendar_modal').modal('hide');

                  var active_yr = $('#temp_active_yr').text();
                 
                  calendaryo(active_yr);
                  // alertify.alert(data).setHeader('Account');
                  // $('#account_form')[0].reset();
                  // $('#account_modal').modal('hide');
                  // dataTable.ajax.reload();
                }
              });
           
          });

            
             
           
          } );


        $(document).on('click', '#filter_year', function(){
            var filter_year = $(this).attr("data-id");
         
            $('#dropdownMenu2').text(filter_year);
            $('#temp_active_yr').text(filter_year);
            calendaryo(filter_year);
            day_absent_present(filter_year);

            });





        </script>
        </body>

</html>
