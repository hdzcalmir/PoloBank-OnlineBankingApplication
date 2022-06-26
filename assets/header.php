<?php 
  include_once('actions/db.php');
  session_start();
  if(!isset($_SESSION['userSession'])) { 
    echo'<script>window.location="index.php";</script>'; 
    killConnection_PDO($db); 
    return true; 
  }
?>
    <div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
      <a href="panel.php"><img src="img/hero.png" href="panel.php" class="logo"></a>
        <ul class="list-unstyled components mb-5">
          <li>
            <a style="color: #666;" href="panel.php"><span class="fa fa-house"></span>Početna</a>
          </li>
          <li>
              <a style="color: #666;" href="placanja.php"><span class="fa fa-wallet"></span>Plaćanja</a>
          </li>
          <li>
            <a style="color: #666;"  href="vise.php"><span class="fa fa-bars"></span>Više</a>
          </li>
          <li>
            <a style="color: #666;" href="index.php?logout='1'"><span class="fa fa-right-from-bracket" id="logout"></span>Odjava</a>
          </li>
        </ul>
      </nav>
      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button> 

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                  <div class="user-nav-info">
                    <img src="img/1.jpg" alt="User Avatar" class="img-fluid">
                    <a class="nav-link"><?php echo $_SESSION['userSession']; ?></a> 
                  </div>
                  </li>
                </li>
              </ul>
            </div>
          </div>
        </nav>