<?php
    session_start();
    include ("lib/connection.php");
    if (empty($_SESSION['faculty'])) 
    {
        header("Location: index.php");
        exit();
    }

    $mem = $_SESSION['faculty'];

    if ($_SESSION['message'])
        $message = $_SESSION['message'];
    $name = $_SESSION['name'];
    
                    
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Events Portal</title>
        <link rel="stylesheet" type="text/css" href="landingStyle.css">
    </head>
    <body>

        <div class="wrapper">
            <header>
            </header>
            <div style="position:absolute; top:10px; right:10px;"> 
                <p> Hi, <?php echo $name; ?> <a href='changePassword.php'> <img src = "icon/setting.png" width = 19px; > </p>
            </div>
            
            <div style = "text-align:center;">
                <?php echo $message; 
                    unset($_SESSION['message']);

                ?>
            </div>
            
            <div id="container"> 
                     
                <div id="left">
                    <img src="images/vit.jpg" alt="VIT University" id="chapLogo">
                      
                </div>  

                <div id="right">
                    <ul>
                        <a href="selectview.php"><li>Screen new events</li></a>
                        <!-- <a href="selectevent.php"><li>Modify an existing event</li></a> -->
                        <a href="selectevent.php"><li>View existing event details</li></a>
                        <a href="logout.php"><li>Sign Out</li></a>
                    </ul>
                </div>
            </div>

            <!--div id="notification" onload="display" style="position: static; margin: auto; height: 25px; color:grey; background-color: #b6ff00; width: 100%; text-align: center;">
                <!php echo "The event (".$title.") was created."; ?>
            </div-->

        <div class="push"></div></div>

        <div class="footer">
             <p style="margin-top: 7px;"></p>
        </div>

        <!--script>
            function display(condition) {
                if (condition == "") { var obj = document.getElementById('notification'); obj.css    }
            }
</script-->
    </body>
</html>
