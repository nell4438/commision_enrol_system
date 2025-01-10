<?php 
include('../session.php');


require_once("../class.user.php");

  
$auth_user = new USER();
// $page_level = 3;
// $auth_user->check_accesslevel($page_level);
$pageTitle = "Manage Gradelevel Subject";
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
        <h1 class="h2">Manage Gradelevel Subject </h1>
        
      </div>

      <div class="table-responsive">
         
         <br><br>
        <table class="table table-striped table-sm" id="gradelevelsub_data">
          <thead>
            <tr>
              <th>#</th>
              <th>Gradelevel</th>
              <th>Academic Year</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            
     
          </tbody>
        </table>

<!--modal subject -->
<div class="modal fade" id="gradelevelsub_modal" tabindex="-1" role="dialog" aria-labelledby="product_modal_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gradelevelsub_modal_title">View Gradelevel Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
           <table class="table table-bordered">
          <tbody>
            <tr>
              <td width="15%">Gradelevel </td>
              <td><span id="info_gradelevel">room_semester</span></td>
            </tr>
            <tr>
              <td >Academic Year </td>
              <td><span id="info_acadyear">room_yearlevel</span></td>
            </tr>
          </tbody>
          
        </table>
      <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#browse_subject_modal">BROWSE SUBJECT</button>
  
      <br><br>
        <table class="table table-bordered" id="grlsubject_data">
          <thead>
            
            <tr>
              <th>ID</th>
              <th>CODE</th>
              <th>SUBJECT</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
          
        </table>

         </div>
        <div class="modal-footer">
          <form  method="post" id="gls_form" enctype="multipart/form-data">
        <input type="hidden" name="sem_ID" id="sem_ID" value="">
        <input type="hidden" name="yl_ID" id="yl_ID" value="">
        <input type="hidden" name="sub_ID" id="sub_ID" value="">
        </form>
          <div class="">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
    
    
    </div><!-- modal content -->
  </div><!--/modal dialog content -->
</div><!--/modal subject -->

<!-- Modal -->
<div class="modal fade" id="browse_subject_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SUBJECT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-sm" id="subject_data">
          <thead>
            <tr>
              <th>#</th>
              <th>Code</th>
              <th>Title</th>
              <th>Abbreviation</th>
            </tr>
          </thead>
          <tbody>
            
     
          </tbody>
        </table>
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
        <script type="text/javascript">
   


          $(document).ready(function() {
             
            var dataTable = $('#gradelevelsub_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
              url:"datatable/gradelevelsub/fetch.php",
              type:"POST"
            },
            "columnDefs":[
              {
                "targets":[0],
                "orderable":false,
              },
            ],

          });
          var dataTable_subject = $('#subject_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
              url:"datatable/subject/fetch.php",
              type:"POST"
            },
            "columnDefs":[
              {
                "targets":[0],
                "orderable":false,
              },
            ],

          });
            function subject_ingradelevel(sem_ID,yl_ID){

          var dataTable_gsub = $('#grlsubject_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "bAutoWidth": false,
            "searching": false,
            "paging":   false,
            "ordering": false,
            "info":     false,

            "ajax":{
              url:"datatable/gradelevelsub/fetch_subject.php?sem_ID="+sem_ID+"&yl_ID="+yl_ID,
              type:"POST"
            },
            "columnDefs":[
              {
                "targets":[0],
                "orderable":false,
              },
            ],

          });

        }

          //JQUERY FOR SELECTING SUB TEACHER IN ROOM  WHEN BROWSING
          //----------------------------------------------------------------
            var sub_Rec = '#subject_data tbody';

            $(sub_Rec).on('click', 'tr', function(){
              
              var cursor = dataTable_subject.row($(this));//get the clicked row
              var data=cursor.data();// this will give you the data in the current row.
               if(confirm("Are you sure you want to add ("+data[1]+" "+data[2]+") to this academic year gradelevel?"))
                {

                  $('#gls_form').find("input[name='sub_ID'][type='hidden']").val(data[0]);
                  var yl_ID = jQuery('#yl_ID').val(); 
                  var sem_ID = jQuery('#sem_ID').val();

                  $.ajax({
                       type        :   'POST',
                       url:"datatable/gradelevelsub/insert.php",
                        data:{operation:"submit_subject",subject_ID:data[0],yl_ID:yl_ID,sem_ID:sem_ID},
                       dataType    :   'json',
                       complete     :   function(data) {

                          alertify.alert(data.responseText).setHeader('Room');
                          $('#grlsubject_data').DataTable().destroy();
                          subject_ingradelevel(sem_ID,yl_ID);
                          
                       }
                      });

                }
                  else
                {
                  return false; 
                }
              $('#browse_subject_modal').modal('hide');
              
            });



          $(document).on('click', '.view', function(){
            var sem_ID = $(this).attr("sem-id");
            var yl_ID = $(this).attr("yl-id");
            $('#gradelevelsub_modal_title').text('View Gradelevel Subject');
            $('#gradelevelsub_modal').modal('show');
            $("#submit_input").hide();
            
             $.ajax({
                url:"datatable/gradelevelsub/fetch_single.php",
                method:'POST',
                data:{action:"gradelevelsub_view",sem_ID:sem_ID,yl_ID:yl_ID},
                dataType    :   'json',
                success:function(data)
                {

                  $('#info_gradelevel').html(data.gradelvl);
                  $('#info_acadyear').html(data.acadyear);
                  $('#sem_ID').val(data.sem_ID);
                  $('#yl_ID').val(data.yl_ID);

                    $('#grlsubject_data').DataTable().destroy();
                    subject_ingradelevel(sem_ID,yl_ID);

                  
                }
              });


            });

             $(document).on('click', '.delete', function(){
                var g_ID = $(this).attr("id");
             
                alertify.confirm(
              'Are you sure you want to remove this subject?', 
              function(){ 
                 $.ajax({
                 type        :   'POST',
                 url:"datatable/gradelevelsub/insert.php",
                  data:{operation:"delete_subject",grls_ID:g_ID},
                 dataType    :   'json',
                 complete     :   function(data) {

                    alertify.alert(data.responseText).setHeader('Gradelevel Subject');
                    $('#grlsubject_data').DataTable().destroy();
                    var yl_ID = jQuery('#yl_ID').val(); 
                    var sem_ID = jQuery('#sem_ID').val();
                    subject_ingradelevel(sem_ID,yl_ID);
                 }
                });
                alertify.success('Ok') 
              }, 
              function(){ 
                alertify.error('Cancel')
              }).setHeader('Gradelevel Subject');
              });

           


     
          
          } );


        </script>
        </body>

</html>
