<?php
include ('../session.php');


require_once ("../class.user.php");


$auth_user = new USER();
// $page_level = 3;
// $auth_user->check_accesslevel($page_level);
$pageTitle = "Manage Enrolled";
?>
<!doctype html>
<html lang="en">

<head>
  <?php
  include ('x-meta.php');
  ?>


  <?php
  include ('x-css.php');
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
  include ('x-nav.php');
  ?>

  <div class="container-fluid">
    <div class="row">
      <?php
      include ('x-sidenav.php');
      ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Manage Enrolled</h1>

        </div>

        <div class="table-responsive">
          <button type="button" class="btn btn-sm btn-success add">
            Add
          </button>
          <br><br>
          <table class="table table-striped table-sm" id="enrolled_data">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Schoolyear</th>
                <th>Gradelevel</th>
                <th>Section</th>
                <th>Adviser</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>


            </tbody>
          </table>
          <div class="modal fade" id="enrolled_modal" tabindex="-1" role="dialog" aria-labelledby="enrolled_modal_title"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="enrolled_modal_title">Add Enrolled</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="product_modal_content">
                  <div class="btn-group float-right">
                    <button class="btn btn-success btn-sm" id='browse_student' data-toggle="modal"
                      data-target="#browse_student_modal">BROWSE STUDENT</button>
                  </div>
                  <br><br>
                  <form method="post" id="enrolledx_form" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="student_name">Student Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="student_name" name="student_name" placeholder=""
                          value="" disabled required="">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="enrolled_acadyr">School Year<span class="text-danger">*</span></label>
                        <select class="form-control" id="enrolled_acadyr" name="enrolled_acadyr">
                          <?php
                          $auth_user->ref_semester();
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="enrolled_gradelevel">Gradelevel<span class="text-danger">*</span></label>
                        <select class="form-control" id="enrolled_gradelevel" name="enrolled_gradelevel">
                          <?php
                          $auth_user->ref_year_level();
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="student_ID" id="student_ID" />
                      <input type="hidden" name="enrolled_ID" id="enrolled_ID" />
                      <input type="hidden" name="operation" id="operation" />
                      <div class="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit" id="submit_input"
                          value="submit_enrolled">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>


          </div>


          <!-- Modal -->
          <div class="modal fade" id="browse_student_modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Browse Student</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table class="table table-striped table-sm" id="student_data">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>LRN</th>
                        <th>Student Name</th>
                        <th>Sex</th>
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





          <div class="modal fade" id="delenrolled_modal" tabindex="-1" role="dialog"
            aria-labelledby="enrolled_modal_title" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="enrolled_modal_title">Delete this enrolled</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="text-center">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-danger" id="enrolled_delform">Delete</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

      </main>
    </div>
  </div>

  <?php
  include ('x-script.php');
  ?>
  <script type="text/javascript">



    $(document).ready(function () {

      var dataTable = $('#enrolled_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "datatable/enrolled/fetch.php",
          type: "POST"
        },
        "columnDefs": [
          {
            "targets": [0],
            "orderable": false,
          },
        ],

      });

      var student_dataTable = $('#student_data').DataTable({
        "processing": true,
        "serverSide": true,
        "bAutoWidth": false,
        "order": [],
        "ajax": {
          url: "datatable/student/fetch.php",
          type: "POST"
        },
        "columnDefs": [
          {
            "targets": [0],
            "orderable": false,
          },
        ],

      });


      //JQUERY FOR SELECTING ENROLLED STUDENT  WHEN BROWSING
      //----------------------------------------------------------------
      var enrolstuddt_Rec = '#student_data tbody';

      $(enrolstuddt_Rec).on('click', 'tr', function () {

        var cursor = student_dataTable.row($(this));//get the clicked row
        var data = cursor.data();// this will give you the data in the current row.
        if (confirm("Are you sure you want to enrolled " + data[2] + "")) {

          $('#enrolledx_form').find("input[name='student_ID'][type='hidden']").val(data[0]);
          $('#enrolledx_form').find("input[name='student_name'][type='text']").val(data[2]);

        }
        else {
          return false;
        }
        $('#browse_student_modal').modal('hide');

      });










      $(document).on('submit', '#enrolledx_form', function (event) {
        event.preventDefault();

        $.ajax({
          url: "datatable/enrolled/insert.php",
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function (data) {
            alertify.alert(data).setHeader('Enrolled');
            $('#enrolledx_form')[0].reset();
            $('#enrolled_modal').modal('hide');
            dataTable.ajax.reload();
          }
        });

      });

      $(document).on('click', '.add', function () {
        $('#enrolled_modal_title').text('Add Enrolled');

        $("#enrolled_title").prop("disabled", true);
        $("#enrolled_acadyr").prop("disabled", false);
        $("#enrolled_gradelevel").prop("disabled", false);
        $('#enrolledx_form')[0].reset();
        $('#enrolled_modal').modal('show');
        $('#submit_input').show();
        $('#browse_student').show();
        $('#submit_input').text('Submit');
        $('#submit_input').val('submit_enrolled');
        $('#operation').val("submit_enrolled");
      });

      $(document).on('click', '.view', function () {
        var enrolled_ID = $(this).attr("id");
        $('#enrolled_modal').modal('show');
        $('#browse_student').hide();


        $.ajax({
          url: "datatable/enrolled/fetch_single.php",
          method: 'POST',
          data: { action: "enrolled_view", enrolled_ID: enrolled_ID },
          dataType: 'json',
          success: function (data) {
console.log(data)
            $("#enrolled_title").prop("disabled", true);
            $("#enrolled_acadyr").prop("disabled", true);
            $("#enrolled_gradelevel").prop("disabled", true);


            $('#student_name').val(data.student_name);
            $('#enrolled_acadyr').val(data.enrolled_acadyr).change();
            $('#enrolled_gradelevel').val(data.enrolled_gradelevel).change();
            $('#student_ID').val(data.student_ID);

            $('#submit_input').hide();
            $('#enrolled_ID').val(enrolled_ID);
            $('#submit_input').text('View');
            $('#submit_input').val('enrolled_view');
            $('#operation').val("enrolled_view");

          }
        });

      });

      $(document).on('click', '.edit', function () {
        var enrolled_ID = $(this).attr("id");
        $('#enrolled_modal_title').text('Edit Enrolled');
        $('#enrolled_modal').modal('show');
        $("#submit_input").show();

        $('#browse_student').hide();

        $.ajax({
          url: "datatable/enrolled/fetch_single.php",
          method: 'POST',
          data: { action: "enrolled_edit", enrolled_ID: enrolled_ID },
          dataType: 'json',
          success: function (data) {



            $("#enrolled_title").prop("disabled", true);
            $("#enrolled_acadyr").prop("disabled", false);
            $("#enrolled_gradelevel").prop("disabled", false);

            $('#student_name').val(data.student_name);
            $('#enrolled_acadyr').val(data.enrolled_acadyr).change();
            $('#enrolled_gradelevel').val(data.enrolled_gradelevel).change();
            $('#student_ID').val(data.student_ID);

            $('#submit_input').show();
            $('#enrolled_ID').val(enrolled_ID);
            $('#submit_input').text('Update');
            $('#submit_input').val('enrolled_update');
            $('#operation').val("enrolled_edit");

          }
        });


      });
      $(document).on('click', '.delete', function () {
        var enrolled_ID = $(this).attr("id");
        $('#delenrolled_modal').modal('show');
        $('.submit').hide();

        $('#enrolled_ID').val(enrolled_ID);
      });




      $(document).on('click', '#enrolled_delform', function (event) {
        var enrolled_ID = $('#enrolled_ID').val();
        $.ajax({
          type: 'POST',
          url: "datatable/enrolled/insert.php",
          data: { operation: "delete_enrolled", enrolled_ID: enrolled_ID },
          dataType: 'json',
          complete: function (data) {
            $('#delenrolled_modal').modal('hide');
            alertify.alert(data.responseText).setHeader('Delete this Enrolled');
            dataTable.ajax.reload();
            dataTable_product_data.ajax.reload();

          }
        })

      });

    });


  </script>
</body>

</html>