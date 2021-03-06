<!DOCTYPE html>
<html lang="en" >

  <head>
    <meta charset="UTF-8">
    <title>Admin Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">
  </head>

  <?php
      session_start();
      if(!isset($_SESSION['admin_id'])){
        header("Location:index.php");
        exit;
      }
  ?>

  <body>

    <!-- Header - Start  -->
    <header id="header">
      <div class="menu-button">
        <div id="nav-icon3">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        </div>
      </div>
      <div id="top-bar">
        <h3 style="font-weight: bold;">Admin Dashboard</h3>
      </div>
    </header>
    <!-- Header - End  -->

    <!-- Navigation - Start  -->
    <nav id="sidemenu">
      <div class="main-menu">
        <ul class='main-menu'>
        <li>
            <a href="adminHome.php">
          <span class='glyphicon glyphicon-home'></span> Home
          </a>
        </li>
        <li >
          <a href="adminAddadmin.php">
          <span class=' glyphicon glyphicon-plus'></span> Add Admin
          </a>
        </li>
        <li  class="link-active">
          <a href="adminListadmin.php">
          <span class=' glyphicon glyphicon-th-list'></span> List All Admins
          </a>
        </li>
        <li>
          <a href="adminListuser.php">
          <span class=' glyphicon glyphicon-th-list'></span> List All Users
          </a>
        </li>
        <li>
          <a href="adminEditaccount.php">
          <span class='glyphicon glyphicon-edit'></span> Edit Account
          </a>
        </li>
        <li class="main-menu">
            <a href="../Controller/Logout.php">
          <span class='glyphicon glyphicon-log-out'></span> Logout
          </a>
        </li>
        </ul>
      </div>
      <p class="copyright">My Notes - &copy; 2018</p>
    </nav>
    <!-- Navigation - End  -->

        
    <div id="content-wrapper">
      <div class="container-fluid">
        <div class="text-center">
          
          <h1>See All Admins</h1>
          <h3>Edit Privilleges & Delete Admins</h3>
          <h1> </h1>
          <div class="row">
            <div class="col-xs-12">
                <div class="text-center">
                  <table class="history-table">
                    <tr>
                      
                      <th>Admin Email</th>
                      <th>Privilleges</th>
                      <th>Delete</th>
                    </tr>
                    <div class="notes">
                <?php
                  
                  include_once ('../Model/admin.php');
                  $a = new admin();
                  $result = $a->listadmins();
                  $curr = $a->admininfo( $_SESSION['admin_id'] );
                  if( $curr[0]['privs']==1 ){


                    while($arr = mysqli_fetch_assoc($result)){
                      if ($arr["privs"] == 2){
                        echo'
  
                      <tr>
                        
                        <td>'.$arr["admin_email"].'</td>
                        <td>All Admin Privileges</td>
                        <td>N/A</td>
                        
                      </tr>
  
                      ';
                      }else{
                        echo'
  
                        <tr>
                          
                          <td>'.$arr["admin_email"].'</td>
                          <td>Block / Delete Users Only</td>
                          <td>N/A</td>

                        </tr>
    
                        ';
                      }
                      
  
                    }




                  }else{


                  while($arr = mysqli_fetch_assoc($result)){
                    if ($arr["privs"] == 2){
                      echo'

                    <tr>
                      
                      <td>'.$arr["admin_email"].'</td>
                      <td>
                        <form action = "../Controller/adminlistadminsblock_controller.php" method="POST">
                        <input class="Bbtn" value="All Admin Privileges" type="submit" name="'.$arr["admin_id"].'">
                        </form>
                      </td>
                      <td>
                        <form action = "../Controller/adminlistadmins_controller.php" method="POST">
                        <input class="Bbtn" value="Delete" type="submit" name="'.$arr["admin_id"].'">
                        </form>
                      </td>
                    </tr>

                    ';
                    }else{
                      echo'

                      <tr>
                        
                        <td>'.$arr["admin_email"].'</td>
                        <td>
                          <form action = "../Controller/adminlistadminsblock_controller.php" method="POST">
                          <input class="Bbtn" value="Block / Delete Users Only" type="submit" name="'.$arr["admin_id"].'">
                          </form>
                        </td>
                        <td>
                          <form action = "../Controller/adminlistadmins_controller.php" method="POST">
                          <input class="Bbtn" value="Delete" type="submit" name="'.$arr["admin_id"].'">
                          </form>
                        </td>
                      </tr>
  
                      ';
                    }
                    

                  }
                }
                ?>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

      <style>
            .Bbtn{
              background-color: #008BFF;
              color: #333;
              border: none;
              padding: 10px 30px;
            }
      </style>
  

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script  src="js/main.js"></script>
  </body>

</html>


