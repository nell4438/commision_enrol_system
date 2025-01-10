
 <nav class="navbar  navbar-expand-lg  navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" style="background-color: #4caf50 !important;">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#" style="width:relative; font-size: 0.9rem;">SNHS Online Enrollment System
</a>

<?php 
   if($auth_user->admin_level()) { 
?>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="navbar-nav px-3 ml-auto">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:white;">Notification</a>
          <ul class="dropdown-menu notify-drop">
            <div class="notify-drop-title">
             
            </div>
            <!-- end notify title -->
            <!-- notify content -->
            <div class="drop-content" style="width: 225px; position:relative;">
              <div class="d-flex flex-column bd-highlight mb-3" style="overflow: scroll !important; max-height:350px;overflow-x: hidden !important; ">
                <?php 
                echo $auth_user->notification();
                ?>
              </div>
            </div>
            <div class="notify-drop-footer text-center">
             
            </div>
          </ul>
        </li>
      </ul>
    </div>
  <?php }?>
    <ul class="navbar-nav px-3 ml-auto">


       <li class="nav-item  dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php $auth_user->getUsername();?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="profile">Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../logout?logout=true">Log Out</a>
        </div>
      </li>
    </ul>
  </nav>

<!--   <nav class="navbar navbar-expand-lg navbar-light bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


    <ul class="navbar-nav px-3">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      
    </ul>
</nav> -->