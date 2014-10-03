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
$_SESSION['eventId'] = $eventNumber;

if(!empty($_REQUEST['mode']))
{
    $mem = $_SESSION['memberId'];
    $mem = mysqli_real_escape_string($mysqli,$mem);

    $title = $_REQUEST['title'];
    $title = mysqli_real_escape_string($mysqli,$title);
    
    $date = $_REQUEST['date'];
    $date = mysqli_real_escape_string($mysqli,$date);
    
    $from = $_REQUEST['from'];
    $from = mysqli_real_escape_string($mysqli,$from);
    
    $till = $_REQUEST['till'];
    $till = mysqli_real_escape_string($mysqli,$till);
    
    $location = $_REQUEST['location'];
    $location =mysqli_real_escape_string ($mysqli,$location);
    
    $desc = $_REQUEST['desc'];
    $desc = mysqli_real_escape_string($mysqli,$desc);

    $sql = "SELECT * FROM event WHERE eventId='$eventNumber' ";
    $res = $mysqli->query($sql);


    $count = $res->num_rows;

    if ($count == 1)
    {
        $data=$res->fetch_array();
        
        $stat = $data['verificationStatus'];
        $posterName = $data['poster'];
     //   $permissionName =$data['permission'];
    }

    if ($stat == "rejected" || $stat == "rejectedMid")
    {
        $sql = "UPDATE event 
                SET 
                    title = '$title',
                    dat = '$date',
                    fromTime = '$from',
                    till = '$till',
                    location ='$location',
                    description = '$desc',
                    verificationStatus='pending' 
                WHERE eventId = '$eventNumber' " ;
        if ( ($_FILES["poster"]["size"] < 2000000) )
        {
            if (!($_FILES["poster"]["error"]) )
            {
                move_uploaded_file($tmpName, "images/posters/".$posterName);
            } 
        }

        // if ( ($_FILES["permissionLetter"]["size"] < 2000000) )
        // {
        //      if (!($_FILES["permissionLetter"]["error"]) )
        //     {
        //         move_uploaded_file($tmpName, "images/permissionLetters/".$permissionName);
        //     } 
        // }

    }
    else if ($stat == "yes" || $stat == "mid")
    {
        $sql = "UPDATE event 
                    SET 
                        fromTime = '$from',
                        till = '$till',
                        location ='$location'
                        WHERE eventId = '$eventNumber' " ; 
    }
    else
    {
        $sql = "UPDATE event 
                SET 
                    title = '$title',
                    dat = '$date',
                    fromTime = '$from',
                    till = '$till',
                    location ='$location',
                    description = '$desc'
                WHERE eventId = '$eventNumber' " ;

        $tmpName=$_FILES['poster']['tmp_name'];
        if ( ($_FILES["poster"]["size"] < 2000000) )
        {
            if (!($_FILES["poster"]["error"]) )
            {
                move_uploaded_file($tmpName, "images/posters/".$posterName);
            } 
        }

        // $tmpName=$_FILES['permissionLetter']['tmp_name'];
        // if ( ($_FILES["permissionLetter"]["size"] < 2000000) )
        // {
        //      if (!($_FILES["permissionLetter"]["error"]) )
        //     {
        //         move_uploaded_file($tmpName, "images/permissionLetters/".$permissionName);
        //     } 
        // }
    }
    $res = $mysqli->query($sql);

    if ($res)
    {
        $message = "Congratulations! Your event has been modified successfully!";
        $_SESSION['message'] = $message;
        unset($_SESSION['eventId']);
        header ("Location: landing.php");
    }
    else
    {
        $message = "There was an error modifying your event! Please try again.";
        $_SESSION['message'] = $message;
        unset($_SESSION['eventId']);
        header("Location: landing.php");
    }
}

else
{
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
        $poster = "images/posters/". $data['poster'];
       // $permission = "images/permissionLetters/". $data['permission'];                                        
    }
    else if ($count == 0)
    {
        $message = "There was no event selected.";
        $_SESSION['message'] = $message;
        header("Location: landing.php");
    } 
}

if ($stat == "yes")
{
    $disable = "disabled";
    $processStatus = " <p style=\"color:green; text-align:center;\"><strong>Approved!</strong> </p>";
}
else if ($stat == "pending")
{
    $disable = "";
    $processStatus = " <p style=\"color:orange; text-align:center;\"><strong>Pending!</strong> </p>";

}
else if ($stat == "mid")
{
    $disable = "disabled";
    $processStatus = " <p style=\"color:orange; text-align:center;\"><strong>Approved by faculty coordinator.</strong> </p>";

}
else if ($stat == "rejected") 
{
    $disable = ""; 
    $processStatus = " <p style=\"color:red; text-align:center;\"><strong>Rejected!</strong> </p>";
   
}


?>

<!-- value = <?//php echo $title; ?>
 -->
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Events Portal</title>
        <link rel="stylesheet" type="text/css" href="eventaddmodStyle.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
        <script src="jq.js"></script>
        <script src="jqUI.js"></script>
    </head>
    <body>

        <div class="wrapper">
                        <script src="home.js"></script>
            <header></header>

            <div style="width: auto; margin: auto; overflow-y:scroll">
            <h1 style="margin-top: 40px; text-align:center;">Modify details for the event</h1>
            
            <form method="POST" enctype="multipart/form-data">

                <input type="hidden" name="mode" value="1" />

                <label class="formLabel">Title</label><br><input type="text" value = "<?php echo $title; ?>" name="title" id="eventTitle" style="margin-bottom: 10px;" required <?php echo $disable; ?>><br>
                
                <label class="formLabel">Date:</label><input type="text" value = "<?php echo $date; ?>" style="width: 112px; margin: 10px 18px 10px auto;" id="date" name="date" placeholder="Click to add" required <?php echo $disable; ?> >

                <label class="formLabel">From:</label><input type="text" value= "<?php echo $from; ?>" id="from" placeholder="HH:MM" pattern="[0-2][0-9]:[0-5][0-9]" title="Standard 24 hour clock" name="from" style="margin-right: 18px; width: 100px;" required>

                <label class="formLabel" style="width: 35px;">Till:</label><input type="text" value= "<?php echo $till; ?>" placeholder="HH:MM" pattern="[0-2][0-9]:[0-5][0-9]" title="Standard 24 hour clock"  id="till" name="till" style="width: 100px;" required><br>
                
                <label class="formLabel" style="width: auto; margin: 10px 10px 10px auto;">Location:</label><input type="text" value= "<?php echo $location; ?>" name="location" style="width: 258px;" required><br>

                <label class="formLabel" style="margin-top: 5px;">Description</label><br>
                <textarea cols="40" rows="8" name="desc" style="max-width: 496px; min-width: 496px; max-height:144px; font-family: Roboto, 'Segoe UI', 'Helvetica';" <?php echo $disable; ?>> <?php echo $desc; ?> </textarea><br>
                
                <label> Poster </label>
                    <a href="<?php echo $poster;?>">
                        <img src="<?php echo $poster; ?>" width=590px >
                    </a>
                <label class="formLabel1" text-align:"center" style="margin-top: 5px;"> Change </label>
                <input type="file" onchange="validation(this.value)" id="poster"  style="font-size: 12px;" name="poster" <?php echo $disable;?> ><br><br>


                </br>
               <!--      <label class="formLabel1" style="margin-top: 5px;"> Permission Letter</label>
                    <a href="<?php echo $permission;?>">
                        <img src="<?php echo $permission; ?>" width=590px style= >
                </a>
                 <label class="formLabel1" style="margin-top: 5px;">Change</label>
                <input type="file" onchange="validation(this.value)" id="permissionLetter"  style="font-size: 12px;" name="permissionLetter" <?php echo $disable; ?>><br><br>
 -->

                <input type="hidden" name ="event" value="<?php echo $eventNumber;?>"  >
                <p style="text-align:center;"> Screening Process</p> <?php echo $processStatus;?>
                
                <div style="text-align:center; paddding:20px;">
                    <input type="submit" id="subBtn" value="Modify Event"> </br></br>
                    <a href="delete.php" id="delBtn"> DELETE EVENT </a>
                </div>
            </form>
            
            


            </div>
        <div class="push"></div></div>

        <div class="footer">
            <p style="margin-top: 7px;"></p>
        </div>
    
        <script>
            $(function () {
                $("#date").datepicker();
                $("#date").datepicker("option", "dateFormat", "yy-mm-dd");
                $("#date").datepicker("option", "showAnim", "slideDown");
            });

            function validation(fileName) {
                var testName = new String(fileName);
                testName = testName.substr(testName.length - 3, testName.length);
                
                if(testName!="png" && testName!="jpg")
                    {alert("Please upload only JPEG or PNG files."); 
                     var clr = $("#poster");
                     clr.replaceWith(clr = clr.clone(true));        //Doesn't work in FF
                     }
            }
	    </script>
    </body>
</html>
