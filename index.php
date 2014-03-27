<?php
 session_start();
 include("lib/connection.php"); 

 if(!empty($_SESSION['memberId']))
 {
        header("Location: landing.php");
        exit();
 }

 if(!empty($_REQUEST['mode']))
    {
                    $user= $_REQUEST['id'];
                    $tempPass= $_REQUEST['pw']; 
                 // SHA Hashing to be done here. 
                 //   $pass = md5($tempPass);   
                    $sqlQuery = "SELECT * FROM member WHERE name = '$user' AND password = '$tempPass' ";
                    $res= $mysqli->query($sqlQuery);

                    if (!$res)
                    {
                        echo "SOMETHING WENT WRONG!";
                    }

                    $row_cnt= $res->num_rows; 

                    echo $row_cnt;
                    
                    if($row_cnt == '1')
                    {                        
                                                $fetch_data=$res->fetch_array(); 
                                                $loginid = $fetch_data['id'];
                                                $name = $fetch_data['name'];
                                                $_SESSION['memberId']=$loginid;
                                                $_SESSION['name'] = $name;
                                                ?>
                                                <script language='javascript'>
                                                    window.location.href="landing.php";
                                                </script>
                    <?php
                    }
                    else
                    {
                    ?>
                                                <script language='javascript'>
                                                    alert("Either 'Login ID' or 'Password' is incorrect. Please Verify ...");
                                                </script>
                    <?php
                    }
    }

?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Events Portal</title>
        <link rel="stylesheet" type="text/css" href="styleSheet.css">
    </head>
    <body>
        <div class="wrapper">

            <header></header>
            
            <div id="container">
                <div id="left" style="position: relative; display: inline-block; margin-right: 15px;">
                    <img src="vitTransparent.png" alt="VIT" style="height: 92px; width: 92px;">
                </div>

                <div id="right" style="position: relative; top: -25px; display: inline-block;">
                    <h4 style="position: relative; bottom: 5px;">Clubs <strong>&</strong> Chapters Portal</h4>
                    
                    
                    <form method = "POST">
                        <input type="hidden" name="mode" value="1" />
                        <label>Identification Code:</label><input type="text" style="width: 150px;" name="id" required autofocus="true"><br>
                        <label>Password:</label><input type="password" style="width: 150px;" name="pw" required>
                        <input type="submit" id="subBtn" value=">"></input>
                    </form>

                </div>
            </div>
        
            <div class="push"></div>
        </div>

        <div class="footer">
            <p style="margin-top: 7px;">Developed and maintained by the Computer Society of India, VIT University Chapter</p>
        </div>
    </body>
</html>
