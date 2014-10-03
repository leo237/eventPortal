<?php
session_start();
include("lib/connection.php"); 
if (empty($_SESSION['memberId']))
{
    header("Location: index.php");
    exit();
}



$eventNumber = $_REQUEST['event'];
$eventNumber = mysqli_real_escape_string($mysqli, $eventNumber);

$_SESSION['eventId'] = $eventNumber;

$sql = "SELECT * FROM event WHERE eventId='$eventNumber' ";
$res = $mysqli->query($sql);

$count = $res->num_rows;

if ($count == 1)
{
    $data=$res->fetch_array(); 

    $title = $data['title'];



    $date = $data['dat'];
    $from = $data['fromTime'];
    $till = $data['till'];
    $location = $data['location'];
    $desc = $data['description'];  
    $stat = $data['verificationStatus'];                                        

    // echo "Title : $title </br>";
    // echo "Date : $date </br>";
    // echo "From : $from</br>";
    // echo "till : $till </br>";
    // echo "location : $location </br>";
    // echo "description : $desc </br>";
    // echo "Verification : $stat";

}
else if ($count == 0)
{
    $message = "There was no event selected.";
    $_SESSION['message'] = $message;
    header("Location: landing.php");
}   

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Events Portal</title>
        <link rel="stylesheet" type="text/css" href="eventaddmodStyle.css">
        <style>
            .wrapper{
                margin: 0 auto -51px;
            }
            
            h2{
                color: #0094ff;
                font-size: 27px;
                margin-bottom: 0px;
                overflow: hidden;
            }
            
            h4{
                font-size: 21px;
                color: #606060;
                margin-bottom: 5px;
            }
            
            form{
                position: static;
                background-color: #fff;
                margin: 0;
                border: none;
                box-shadow: none;
                padding: 0;
                width: auto;
            }
            
            #subBtn{
                margin: 20px auto 5px 166px;
            }
            
            .deny{
                background-color: #e60808;
            }
            
            .allow{
                background-color: #23bc0c;
            }
           
        </style>
    </head>
    <body>

        <div class="wrapper">
        
            <header></header>
            
            <div style="position: absolute; height: 265px; width: 532px; margin: auto; left: 0; right: 0; top: 0; bottom: 0px;">
                <form>
                <h2><?php echo $title;?></h2>
                <div style="border: 1px solid #b2b0b0; box-shadow: 0 0 10px darkgrey; padding: 10px; height: 150px; width: 510px;">
                    <div style="float: left; margin-right: 20px; width: 140px;">
                        <h4><?php echo $date; ?></h4>
                        <h4 style="display: inline-block;"><?php echo $from; ?></h4>
                        <h5 style="display: inline-block; margin: 0 3px; font-size: 18px;">-</h5>
                        <h4 style="display: inline-block;"><?php echo $till; ?></h4>
                        <h4><?php echo $location; ?></h4>
                    </div>
                    <div style="float: left; border: 1px solid darkgrey; width: 338px; height: 138px; overflow-y: scroll; padding: 5px;">
                        <p><?php echo $desc; ?></p>
                    </div>
                </div>
                <input type="submit" id="subBtn" value="Permission control">
                </form>
            </div>
        
        </div>
        <div class="footer">
            <p style="margin-top: 7px;"></p>
        </div>

    <script type="text/ecmascript">
        var status; // 0 - Currently denied (button will grant permission) | 1 - Currently approved (button will deny permission)
        status = 1;// this was just for testing! remove it
        var btn = document.getElementById('subBtn');
        window.onload = function () {
            if (status == 0) {
                btn.style.backgroundColor = "#23bc0c";
                btn.value = "Grant permission";
            }

            else {
                btn.style.backgroundColor = "#e60808";
                btn.value = "Deny permission";
            }
        }
    </script>
    </body>

</html>
