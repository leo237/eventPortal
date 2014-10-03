<?php
session_start();
include("lib/connection.php"); 
if (empty($_SESSION['memberId']))
{
    header("Location: index.php");
    exit();
}

$eventNumber = $_REQUEST['event'];
$eventNumber = mysqli_real_escape_string($mysqli,$eventNumber);

$_SESSION['eventId'] = $_REQUEST['event'];



$sql = "SELECT * FROM event WHERE eventId='$eventNumber' ";
$res = $mysqli->query($sql);

$count = $res->num_rows;

if ($count == 1)
{
    $data=$res->fetch_array(); 

    $title = $data['title'];



    $originalDate = $data['dat'];
    $from = $data['fromTime'];
    $till = $data['till'];
    $location = $data['location'];
    $desc = $data['description'];  
    $stat = $data['verificationStatus'];   
    $poster = "images/posters/" . $data['poster'];
    //$permission = "images/permissionLetters/" . $data['permission'];
    $comments = $data['comments'];

    $date = date("d-m-Y", strtotime($originalDate));
                                     

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

if ($stat == "yes")
{
    $processStatus = " <h8 style=\"color:green; text-align:center; margin-top:10px;\"><strong>Approved!</strong> </h8>";
}
else if ($stat == "pending")
{
    $processStatus = " <h8 style=\"color:orange; text-align:center; margin-top:10px;\"><strong>Pending!</strong> </h8>";

}
else if ($stat == "mid")
{
    $processStatus = " <h8 style=\"color:orange; text-align:center; margin-top:10px;\"><strong>Approved by Faculty Coordinator!</strong> </h8>";

}
else if ($stat == "rejected") 
{
    $processStatus = " <h8 style=\"color:red; text-align:center; margin-top:10px;\"><strong>Rejected!</strong> </h8>";
   
} 
else if ($stat == "rejectedMid") 
{
    $processStatus = " <h8 style=\"color:red; text-align:center; margin-top:10px;\"><strong>Rejected by Faculty Coordinator!</strong> </h8>";
   
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
            <script src="home.js"></script>
        
            <header></header>
            
            <div style="height: auto; width: 600px; margin: auto; left: 0; right: 0; top: 0; bottom: 0px;">
                <form>
                <h2><?php echo $title;?></h2>
                <div style="border: 1px solid #b2b0b0; box-shadow: 0 0 10px darkgrey; padding: 10px; height: auto; width: 600px; text-align:center;">
                    <div style="float: left; margin-right: 20px; margin-top:20px; text-align:center; width: 140px;">
                        <h4 style="color:black;"> <i><u>Date</u></i></h4>
                        <h4><?php echo $date; ?></h4>
                        <h4 style="color:black;"> <i><u>Time</u></i></h4>
                        <h4 style="display: inline-block;"><?php echo $from; ?></h4>
                        <h5 style="display: inline-block; margin: 0 3px; font-size: 18px;">-</h5>
                        <h4 style="display: inline-block;"><?php echo $till; ?></h4>
                        <h4 style="color:black;"> <i><u>Place</u></i></h4>
                        <h4><?php echo $location; ?></h4>
                    </div>
                    <div style="margin-bototm:20px;float: left; border: 1px solid darkgrey; width: 400px; height: 238px; overflow-y: scroll; padding: 5px; ">
                        <p><?php echo $desc; ?></p>

                    </div>
                    </br></br> </br> </br>
                    <label style="margin-top:20px;"><i> <u>Poster</i></u> </label><br>
                    <a href="<?php echo $poster;?>">
                        <img src="<?php echo $poster; ?>" width=550px style= >
                    </a>
                </br>
                  <!--   <label> Permission Letter</label>
                    <a href="<?php echo $permission;?>">
                        <img src="<?php echo $permission; ?>" width=550px style= >
                    </a> -->
                    <?php
                        if ($comments)
                        {
                            echo "<label> <u>Comments:</u> </label>";
                            echo "<h8 style=\"color:blue; text-align:center; margin-top:10px;\">" . $comments .  "</h8></br></br>";
                        }  
                    ?> 
                    <p> Verification status : <?php echo $processStatus; ?> </p>

                </div>
                </form>
            </div>
        
        </div>
        <div class="footer" style="margin-top:60px;">
            <p style="margin-top: 7px;"></p>
        </div>

    
    </body>

</html>
