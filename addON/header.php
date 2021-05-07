
    <?php
    // session_start();
    if (isset($_GET['logoutPress'])) {
      session_destroy();
      header("Location: Read.php");
    }
    ?>
    
    <header>
        
           <!-- navbar -->
          
        <nav class="navbar navbar-expand-lg navbar-light">
            <div id="idColor" class="container-fluid">
              <a style="color: #d8e3e7;" class="navbar-brand" href="Read.php"><h3>HOTELI</h3></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a style="color: #d8e3e7;" class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item ">
                    <a style="color: #d8e3e7;" class="nav-link" href="#">About US</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a style="color: #d8e3e7;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      DropDown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                </ul>
               
                <form class="d-flex float-end">   
                <?php

                if(isset($_SESSION['LogOut'])) {
                  // echo '<a href="'.$_SESSION['LogOut'].'" class="btn btn-outline-light">Logout</a>';
                  $a_text = 'Logout';
                  $a_link = $_SESSION['LogOut'];
                }
                else {
                  $a_text = 'Login';
                  $a_link = 'login.php';
                }

                ?>

                <a href="<?php echo $a_link; ?>" class="btn btn-outline-light"><?php echo $a_text; ?></a>

                </form>
              </div>
            </div>
          </nav>
          
           <!-- navbar end -->
          
    </header>