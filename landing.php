<?php
    session_start();
    include ("lib/connection.php");
    if (empty($_SESSION['memberId'])) 
    {
        header("Location: index.php");
        exit();
    }

    $mem = $_SESSION['memberId'];
    $mem = mysqli_real_escape_string($mysqli,$mem);
    $sqlQuery = "SELECT * FROM member WHERE id = '$mem' ";
    $res = $mysqli->query($sqlQuery);

    if (!$res)
    {
        echo $mysqli->error;
    }

    $count = $res->num_rows;
    if ($count == 1)
    {
        $data=$res->fetch_array(); 
        $image = $data['image'];                                            
    }

    if ($_SESSION['message'])
        $message = $_SESSION['message'];
    
                    
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
            <header></header>
            
            <div style = "text-align:center;">
                <?php echo $message; 
                    unset($_SESSION['message']);

                ?>
            </div>
            
            <div id="container"> 
                     
                <div id="left">
                    <img src="images/<?php echo $image; ?>.jpg" alt="." id="chapLogo">
                      
                </div>  

                <div id="right">
                    <ul>
                        <a href="addevent.php"><li>Create a <strong>new</strong> event</li></a>
                        <a href="selectevent.php"><li>Modify an existing event</li></a>
                        <a href="selectview.php"><li>View event details</li></a>
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
