<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
    </head>
    <body>
        <div>
            <?php 
                $action = "home";
                include "includes\boostrap.php";
                include "includes\header.php";     
                include "includes\dbconnect.php"    
            ?>
        </div>
        <br><br><br><br>
        <div class="container-fluid" style="padding-left:100px;padding-right:100px;padding-top:20px;"> <!--makes a contrain with padding so the all the items on the page are not stretched to edge of the page -->
        <?php
        //if statement to check if there is a user logged in, if not it will display a window telling the user they need to log in
        if(isset($_SESSION['login_ID'])){

        }else{?>
        <h1>Welcome to the Coursework System</h1>
        <br>
        <div class="col-md-5">
        <div class="alert alert-info" role="alert">Please <b>login in</b> before accessing specific sections of the site</div>
        <?php
        }
        ?>
        </div>
    </body>

</html>
