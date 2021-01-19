<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index1.php">
              <!--<i class="mdi mdi-home menu-icon"></i>-->
              <i class="mdi mdi-chart-bar menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-file-find menu-icon"></i>
              <span class="menu-title">Records</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="listreg.php">Registration</a></li>
                <li class="nav-item"> <a class="nav-link" href="listhealth.php">Health Survey</a></li>
                <li class="nav-item"> <a class="nav-link" href="listtrace.php">Contact Tracing</a></li>
              </ul>
            </div>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-library-books menu-icon"></i>
              <span class="menu-title">Reports Per Campus </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="clistreg.php">Registration</a></li>
                <li class="nav-item"> <a class="nav-link" href="clisthealth.php">Health Survey</a></li>
                <li class="nav-item"> <a class="nav-link" href="clisttrace.php">Contact Tracing</a></li>

                <li class="nav-item"> <a class="nav-link" href="clistlocvitemp.php">Locations visited <br><br> per employee</a></li> 
                <li class="nav-item"> <a class="nav-link" href="clistlogsheet.php">Log sheet</a></li>
                <li class="nav-item"> <a class="nav-link" href="clistloc.php">Most Visited locations</a></li>
                <li class="nav-item"> <a class="nav-link" href="clistvitperloc.php">Visitors per location</a></li>
              </ul>
            </div>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-file-document menu-icon"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="listlocvitemp.php">Locations visited <br><br> per employee</a></li> 
                <li class="nav-item"> <a class="nav-link" href="listlogsheet.php">Log sheet</a></li>
                <li class="nav-item"> <a class="nav-link" href="listloc.php">Most Visited locations</a></li>
                <li class="nav-item"> <a class="nav-link" href="listvitperloc.php">Visitors per location</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="qrcodegen.php">
              <i class="mdi mdi-qrcode menu-icon"></i>
              <span class="menu-title">QR Code Generator</span>
            </a>
          </li>

        <?php 
          if($_SESSION['position']=='1')
          {
           echo'<li class="nav-item">
            <a class="nav-link" href="settings.php">
              <i class="mdi mdi-settings menu-icon"></i>
              <span class="menu-title">Settings</span>
               <span class="nav-profile-name"></span>
            </a>
          </li>'; 
          }
         ?>
         

         <?php 
          if($_SESSION['position']<>'1')
          {
           echo'<li class="nav-item">
            <a class="nav-link" href="usertype.php">
              <i class="mdi mdi-account-key menu-icon"></i>
              <span class="menu-title">Add User Type</span>
            </a>
          </li>';
        }?>
        </ul>
      </nav>