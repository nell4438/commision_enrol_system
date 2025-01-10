
<script src="assets/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="assets/js/jquery-3.3.1.min.js" ></script>
      <script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script><script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
      <script src="assets/plugins/alertifyjs/alertify.min.js"></script>

    <script src="assets/plugins/owlcarousel/dist/owl.carousel.js"></script>
<script>
						    // When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  
  $('html,body').animate({ scrollTop: 0 }, 'slow');
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

}

$(document).ready(function() {
              $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 2,
                    nav: true,
                    loop: false,
                    margin: 20
                  }
                }
              })
            })
</script>
<?php if ($page == "map")  { ?>
<script>
  function initMap() {
        var myLatLng = {lat: 14.3737069, lng: 120.9240774};

        var map = new google.maps.Map(document.getElementById('googleMap'), {
          zoom: 15,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'general tomas mascardo national high school'
        });
      }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfPKc1jcQM-i3bxv2ipJ6u9zJ1Jujh6yo&callback=initMap"></script>
<?php } ?>
<?php if ($page == "news")  { ?>
<script type="text/javascript" src="assets/plugins/datatables/datatables.min.js"></script>
<script>
  $(document).ready(function() {
             
            var dataTable = $('#news_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
              url:"dashboard/datatable/news/fetch.php",
              type:"POST"
            },
            "columnDefs":[
              {
                "targets":[0],
                "orderable":false,
              },
            ],

          });
  });
</script>
<?php } ?>
<?php if ($page == "admission")  { ?>




  <link rel="stylesheet" href="assets/plugins/datepicker/jquery-ui.css">
  <link rel="stylesheet" href="assets/plugins/datepicker/style.css">
  <script src="assets/plugins/datepicker/jquery-ui.js"></script>


<script type="text/javascript" src="assets/plugins/smartwizard/dist/js/jquery.smartWizard.min.js"></script>

<script type="text/javascript">
    function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
 
         return true;
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

            
      function getAge(DOB) {
          var today = new Date();
          var birthDate = new Date(DOB);
          var age = today.getFullYear() - birthDate.getFullYear();
          var m = today.getMonth() - birthDate.getMonth();
          if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
              age = age - 1;
          }

          return age;
      }
      function age(dt){
        
        // var dtV = dt;
        // var exploded=dtV.split("-");
        // var d = new Date(exploded[2],exploded[1],exploded[0]);
        console.log(dt);
        var age = getAge(dt);
        $('#adm_bod_age').val(age);
      }

      $(document).on('change', $("#adm_bod"), function(el) {
          console.log($(el.target).val());
          age($(el.target).val());
      });

      function calculateBmi() {
      var weight = document.step3.adm_weight.value;
      var height = document.step3.adm_height.value;
      if(weight > 0 && height > 0)
      { 
        var finalBmi = weight/(height/100*height/100)
        var finalBmi = finalBmi.toFixed(2)

        document.step3.adm_bmis.value = finalBmi;
        
        $('#adm_bmistat').val(finalBmi);
          if(finalBmi < 18.5){
            $('#adm_bmis').val("Thin.");
          }
          if(finalBmi > 18.5 && finalBmi < 25){
            $('#adm_bmis').val("Healthy.");
          }
          if(finalBmi > 25){
            $('#adm_bmis').val("Overweight.");
          }
      }
      else{
        // alert("Please Fill in everything correctly")
      }
      }
    // var age_input = $('#age_input').val();
    // $('#calculated_age').value(getAge(age_input));

        $(document).ready(function(){

            // $(document).on('change', '#adm_fname', function(){
            //   alert('change');
            
            
            // });

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
               //alert("You are on step "+stepNumber+" now");
               if(stepPosition === 'first'){
                   $("#prev-btn").addClass('disabled');
                   $("#finish-btn").hide();
               }else if(stepPosition === 'final'){
                   $("#next-btn").hide();
                   $("#finish-btn").show();
               }else{
                   $("#finish-btn").hide();
                   $("#next-btn").show();
                   $("#prev-btn").removeClass('disabled');
               }
            });

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){ alert('Finish Clicked'); });
            var btnCancel = $('<button></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ $('#smartwizard').smartWizard("reset"); });

            // Smart Wizard 1
            $('#smartwizard').smartWizard({
                    selected: 0,
                    theme: 'arrows',
                    transitionEffect:'fade',
                    showStepURLhash: false,
                    toolbarSettings: {toolbarPosition: 'none',
                                      toolbarExtraButtons: [btnFinish, btnCancel]
                                    }
            });

            

            // External Button Events
             var page = 1;

            $("#prev-btn").on("click", function() {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                page--;
                console.log(page);
                return true;
            });

            function check_input(input,msg){
              if (
                  input == null || input == ""){
                  alertify.alert(msg).setHeader('Admission Form Error');
                  return false;
                }

            }
            $("#next-btn").on("click", function() {
                // Navigate next
               
                var adm_gradelevel = $('#adm_gradelevel').val();
                var adm_fname = $('#adm_fname').val();
                var adm_mname = $('#adm_mname').val();
                var adm_lname = $('#adm_lname').val();
                var adm_email = $('#adm_email').val();
                var adm_bod = $('#adm_bod').val();
                var adm_sex = $('#adm_sex').val();
                var adm_address = $('#adm_address').val();
                var adm_pg_name = $('#adm_pg_name').val();
                var adm_pg_contact = $('#adm_pg_contact').val();
                var adm_height = $('#adm_height').val();
                var adm_weight = $('#adm_weight').val();
                var vrfy;
                if (page == 1){
                    if (check_input(adm_fname,"First Name Is Required") == false){
                      
                       vrfy = false;
                    }
                    else if (check_input(adm_mname,"Middle Name Is Required") == false){
                       vrfy = false;
                    }
                    else if (check_input(adm_lname,"Last Name Is Required") == false){
                       vrfy = false;
                    }
                    else if (check_input(adm_email,"Email Is Required") == false){
                       vrfy = false;
                    }

                    else if (check_input(adm_bod,"Birthday Is Required") == false){
                       vrfy = false;
                    }
                    else if (check_input(adm_sex,"Sex Is Required") == false){
                       vrfy = false;
                    }
                    else if (check_input(adm_address,"Address Is Required") == false){
                       vrfy = false;
                    }
                    else{
                     vrfy = true;
                      
                    }
                }
                if (page == 2){
                      if (check_input(adm_pg_name,"Parent Name Is Required") == false){
                        vrfy = false;
                      }
                      else if (check_input(adm_pg_contact,"Contact Is Required") == false){
                         vrfy = false;
                      }
                   
                       else{
                       vrfy = true;
                        
                      }

                }
                if (page == 3){
                     
                      if (check_input(adm_height,"Height Is Required") == false){
                         vrfy = false;
                      }
                      else if (check_input(adm_weight,"Weight Is Required") == false){
                         vrfy = false;
                      }
                       else{
                       vrfy = true;
                        
                      }

                }


                if (vrfy == false){

                }
                else{

                  page++;
                 $('#smartwizard').smartWizard("next");
                 return true;
                }

                 console.log(page);
             
                
                  
                
            });
            
            $("#finish-btn").on("click", function() {
               
                // alertify.alert('Finish Clicked').setHeader('Admission Form');

                var datastr  = '';
                datastr += 'action=admission'+ '&';
                datastr += 'adm_classification=' + jQuery('#adm_classification').val() + '&';
                datastr += 'adm_lrn=' + jQuery('#adm_lrn').val() + '&';
                datastr += 'adm_gradelevel=' + jQuery('#adm_gradelevel').val() + '&';
                datastr += 'adm_fname=' + jQuery('#adm_fname').val() + '&';
                datastr += 'adm_mname=' + jQuery('#adm_mname').val() + '&';
                datastr += 'adm_lname=' + jQuery('#adm_lname').val() + '&';
                datastr += 'adm_suffix=' + jQuery('#adm_suffix').val() + '&';
                datastr += 'adm_email=' + jQuery('#adm_email').val() + '&';
                datastr += 'adm_bod=' + jQuery('#adm_bod').val() + '&';
                datastr += 'adm_bod_age=' + jQuery('#adm_bod_age').val() + '&';
                datastr += 'adm_sex=' + jQuery('#adm_sex').val() + '&';
                datastr += 'adm_address=' + jQuery('#adm_address').val() + '&';
                datastr += 'adm_house=' + jQuery('#adm_house').val() + '&';
                datastr += 'adm_pg_name=' + jQuery('#adm_pg_name').val() + '&';
                datastr += 'adm_pg_contact=' + jQuery('#adm_pg_contact').val() + '&';
                datastr += 'adm_pg_alt_contact=' + jQuery('#adm_pg_alt_contact').val() + '&';
                datastr += 'adm_parentjob=' + jQuery('#adm_parentjob').val() + '&';
                datastr += 'adm_studliving=' + jQuery('#adm_studliving').val() + '&';
                datastr += 'adm_height=' + jQuery('#adm_height').val() + '&';
                datastr += 'adm_weight=' + jQuery('#adm_weight').val() + '&';
                datastr += 'adm_bmis=' + jQuery('#adm_bmis').val() + '&';
                datastr += 'adm_bmistat=' + jQuery('#adm_bmistat').val() + '&';
                datastr += 'adm_FeedProg=' + jQuery('#adm_FeedProg').val() + '&';
                datastr += 'adm_InDeworming=' + jQuery('#adm_InDeworming').val() + '&';
                datastr += 'enrolee_medDecease1=' + jQuery('#enrolee_medDecease1').val() + '&';
                datastr += 'enrolee_medDecease2=' + jQuery('#enrolee_medDecease2').val() + '&';
                datastr += 'enrolee_medDecease3=' + jQuery('#enrolee_medDecease3').val() + '&';
                datastr += 'enrolee_medDecease4=' + jQuery('#enrolee_medDecease4').val() + '&';
                datastr += 'enrolee_medDeceaseDate1=' + jQuery('#enrolee_medDeceaseDate1').val() + '&';
                datastr += 'enrolee_medDeceaseDate2=' + jQuery('#enrolee_medDeceaseDate2').val() + '&';
                datastr += 'enrolee_medDeceaseDate3=' + jQuery('#enrolee_medDeceaseDate3').val() + '&';
                datastr += 'enrolee_medDeceaseDate4=' + jQuery('#enrolee_medDeceaseDate4').val();






                
             


                   alertify.confirm(
                    'Are you sure you want to submit your pre-enrolment?', 
                    function(){ 
                         $.ajax({
                        url:"data-admission.php",
                        method:'POST',
                        data:datastr,
                        cache: false, 
                        type:  'json',
                        success:function(data)
                        {
                          var newdata = JSON.parse(data);
                          if (newdata.success) {
                            alertify.alert(newdata.success).setHeader('Admission Success');
                            window.location.assign("index");
                          }
                          else{
                            alertify.alert(newdata.error).setHeader('Admission Error');
                          }
                        }
                      });
                      alertify.success('Ok') 
                    }, 
                    function(){ 
                      alertify.error('Cancel')
                    }).setHeader('Enrolment Form');

                return true;
            });

            $("#print_form").on("click", function() {

                var datastr  = '';
                datastr += 'action=print_admission'+ '&';
                datastr += 'adm_classification=' + jQuery('#adm_classification').val() + '&';
                datastr += 'adm_lrn=' + jQuery('#adm_lrn').val() + '&';
                datastr += 'adm_gradelevel=' + jQuery('#adm_gradelevel').val() + '&';
                datastr += 'adm_fname=' + jQuery('#adm_fname').val() + '&';
                datastr += 'adm_mname=' + jQuery('#adm_mname').val() + '&';
                datastr += 'adm_lname=' + jQuery('#adm_lname').val() + '&';
                datastr += 'adm_suffix=' + jQuery('#adm_suffix').val() + '&';
                datastr += 'adm_email=' + jQuery('#adm_email').val() + '&';
                datastr += 'adm_bod=' + jQuery('#adm_bod').val() + '&';
                datastr += 'adm_bod_age=' + jQuery('#adm_bod_age').val() + '&';
                datastr += 'adm_sex=' + jQuery('#adm_sex').val() + '&';
                datastr += 'adm_address=' + jQuery('#adm_address').val() + '&';
                datastr += 'adm_house=' + jQuery('#adm_house').val() + '&';
                datastr += 'adm_pg_name=' + jQuery('#adm_pg_name').val() + '&';
                datastr += 'adm_pg_contact=' + jQuery('#adm_pg_contact').val() + '&';
                datastr += 'adm_pg_alt_contact=' + jQuery('#adm_pg_alt_contact').val() + '&';
                datastr += 'adm_parentjob=' + jQuery('#adm_parentjob').val() + '&';
                datastr += 'adm_studliving=' + jQuery('#adm_studliving').val() + '&';
                datastr += 'adm_height=' + jQuery('#adm_height').val() + '&';
                datastr += 'adm_weight=' + jQuery('#adm_weight').val() + '&';
                datastr += 'adm_bmis=' + jQuery('#adm_bmis').val() + '&';
                datastr += 'adm_bmistat=' + jQuery('#adm_bmistat').val() + '&';
                datastr += 'adm_FeedProg=' + jQuery('#adm_FeedProg').val() + '&';
                datastr += 'adm_InDeworming=' + jQuery('#adm_InDeworming').val() + '&';
                datastr += 'enrolee_medDecease1=' + jQuery('#enrolee_medDecease1').val() + '&';
                datastr += 'enrolee_medDecease2=' + jQuery('#enrolee_medDecease2').val() + '&';
                datastr += 'enrolee_medDecease3=' + jQuery('#enrolee_medDecease3').val() + '&';
                datastr += 'enrolee_medDecease4=' + jQuery('#enrolee_medDecease4').val() + '&';
                datastr += 'enrolee_medDeceaseDate1=' + jQuery('#enrolee_medDeceaseDate1').val() + '&';
                datastr += 'enrolee_medDeceaseDate2=' + jQuery('#enrolee_medDeceaseDate2').val() + '&';
                datastr += 'enrolee_medDeceaseDate3=' + jQuery('#enrolee_medDeceaseDate3').val() + '&';
                datastr += 'enrolee_medDeceaseDate4=' + jQuery('#enrolee_medDeceaseDate4').val();

                   alertify.confirm(
                    'Are you sure you want to print this pre-enrolment?', 
                    function(){ 

                        $('#print_frame').attr('src', "print.php?"+datastr);
                        $('#print_modal').modal('show');

                      alertify.success('Generate Print Success') 
                    }, 
                    function(){ 
                      alertify.error('Cancel')
                    }).setHeader('Enrolment Form');

                return true;
              

            });

            $("#zst1").on("click", function() {
               page = 1;
                 console.log(page);

            });
            $("#zst2").on("click", function() {
               page = 2;
                 console.log(page);

            });
            $("#zst3").on("click", function() {
               page = 3;
                 console.log(page);

            });
            $("#zst4").on("click", function() {
               page = 4;
                 console.log(page);

            });

          
            // $('#adm_bod').datepicker('option', 'minDate', new Date("1970"));
            // $('#adm_bod').datepicker('option', 'maxDate', new Date("2000"));
             // $(".restricting").datepicker({ 
             //      yearRange: "-40:-20", // this is the option you're looking for
             //      showOn: "both", 
             //      buttonImage: "templates/images/calendar.gif", 
             //      buttonImageOnly: true 
             //  });
               // $('#adm_bod').datepicker('destroy');
               
             $( "#adm_bod" ).datepicker({
               yearRange: "-40:-20",
                changeMonth: true,
                changeYear: true
              });




        });


    </script>
<?php } ?>
<?php if(isset($_REQUEST["admission_ID"])){?>
<script>
   function goto_index(){
    window.location.assign("index");
  }
 $(document).on('submit', '#admission_files_form', function(event){
     event.preventDefault();
     $.ajax({
      url:"data-admission.php?action=admission_files&admission_ID=<?php echo $_REQUEST["admission_ID"]?>",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      type:  'json',
      success:function(data)
      {
       
        var newdata = JSON.parse(data);
        
        if (newdata.success) {
          alert(newdata.success);
          setInterval(goto_index(), 5000);
      
          // alertify.alert(newdata.success).setHeader('Admission File Requirements');
          
        }
        else{
          // alertify.alert(newdata.error).setHeader('Admission File Requirements');
          alert("Admission File Requirements");
        }
      }
    });
  });

</script>
  <?php } ?>
<?php if ($page == "demographic")  { ?>

   <script src="assets/plugins/canvasjs/canvasjs.min.js"></script>
        <script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title: {
    text: ""
  },
  data: [{
    type: "pie",
    startAngle: 240,
    yValueFormatString: "##0.00\"%\"",
    indexLabel: "{label} {y}",
    dataPoints: [
    <?php 
    include("chartjs_json.php");
    ?>
    ]
  }]
});
var chart1 = new CanvasJS.Chart("chartContainer1", {
  animationEnabled: true,
  title: {
    text: ""
  },
  data: [{
    type: "pie",
    startAngle: 240,
    yValueFormatString: "##0.00\"%\"",
    indexLabel: "{label} {y}",
    dataPoints: [
    <?php 
    include("chartjs_json.php");
    ?>
    ]
  }]
});
chart.render();
chart1.render();

 // $.ajax({
 //    url:"chartjs_json.php",
 //    method:'GET',
 //    contentType:false,
 //    processData:false,
 //    success:function(data)
 //    {
 //      alert(data.y);
 //    }
 //  });

}
</script>

<?php } ?>








