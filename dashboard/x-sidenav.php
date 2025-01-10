<?php 
echo $current_url = $_SERVER['REQUEST_URI'];
$url_explde = explode('/', $current_url);
$pagefile_name = $url_explde[3];

function navlist($pagefile_name, $name, $link, $icon) {
  $active_ul_snav = $pagefile_name == $link ? "active" : '';
  $active_ul_snav_span = $pagefile_name == $link ? '<span class="sr-only">(current)</span>' : '';
  ?>
   <li class="nav-item">
      <a class="nav-link <?php echo $active_ul_snav; ?>" href="<?php echo $link; ?>">
        <span data-feather="<?php echo $icon; ?>"></span>
        <?php echo $name . ' ' . $active_ul_snav_span; ?>
      </a>
    </li>
  <?php
}
?>

<style>
  .nav-link {
    color: white !important; 
  }
  svg {
    color: white !important; 
  }
  .nav-link:hover {
    background-color: #39833c;
  }

  ul ul a {
    padding-left: 50px !important;
  }
  ul ul a:hover {
    background: #eee;
    padding-left: 50px !important;
  }

  .sidebar {
    background: #61ba6d !important;
    background: -webkit-linear-gradient(to right, #61ba6d, #83c331) !important;
    background: linear-gradient(to right, #61ba6d, #83c331) !important;
    color: white;
  }

  .sidebar-sticky {
    overflow-x: hidden;
    overflow-y: auto;
  }

  .profile-img {
    height: 85px;
    width: 85px;
    border: 1px solid;
  }

  .sidebar .nav-item {
    display: block;
  }

  @media (max-width: 767.98px) {
    .sidebar {
      position: fixed;
      width: 100%;
      height: auto;
      z-index: 1000;
      display: block; /* Ensure sidebar is visible on small screens */
    }

    .sidebar-sticky {
      max-height: calc(100vh - 130px);
    }
  }

  @media (min-width: 768px) and (max-width: 991.98px) {
    .sidebar {
      position: fixed;
      width: 250px;
      height: 100%;
    }

    .sidebar-sticky {
      max-height: calc(100vh - 130px);
    }
  }
</style>

<nav class="col-md-2 bg-light sidebar">
  <div class="sidebar-sticky">
    <div class="text-center" style="height: 130px;">
      <img id="c_img" src="<?php $auth_user->getUserPic(); ?>" alt="Profile Image" class="rounded-circle profile-img" />
      <br>
      <h6><?php $auth_user->getSidenavUserInfo(); ?></h6>
    </div>

    <ul class="nav flex-column">
      <?php 
      navlist($pagefile_name, "Dashboard", "index", 'home');
      if($auth_user->admin_level()) { 
        navlist($pagefile_name, "Account", "account", "users");
        navlist($pagefile_name, "Admission " . $auth_user->count_newadmission(), "admission", "user");
        navlist($pagefile_name, "Room", "room", "monitor");
        navlist($pagefile_name, "News", "news", "wind");
        navlist($pagefile_name, "Academic Staff", "staff", "users");
        navlist($pagefile_name, "Admin Record", "admin", "book");
        navlist($pagefile_name, "Student Record", "student", "book");
        navlist($pagefile_name, "Teacher Record", "teacher", "book");
      ?>
        <li class="nav-item">
          <a href="#submenu_class" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">
            <span data-feather="book"></span> Class
          </a>
          <ul class="collapse list-unstyled" id="submenu_class">
            <li><a href="subject" class="nav-link"> Subject List</a></li>
            <li><a href="yearlevel" class="nav-link"> Year Level</a></li>
            <li><a href="section" class="nav-link"> Section</a></li>
            <li><a href="acadamicyear" class="nav-link"> Academic Year</a></li> 
            <li><a href="enrolled" class="nav-link"> Enrolled Student</a></li>
            <li><a href="gradelvlsubject" class="nav-link"> Gradelevel Subject</a></li>
          </ul>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>

<!-- Button to toggle sidebar on smaller screens -->
<button id="sidebarToggle" class="btn btn-primary d-md-none">Toggle Sidebar</button>

<!-- JavaScript for toggling sidebar -->
<script>
  document.getElementById('sidebarToggle').addEventListener('click', function () {
    var sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('sidebar-open');
  });
</script>

