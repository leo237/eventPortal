<?php
session_start();
include("lib/connection.php"); 
if (empty($_SESSION['memberId']))
{
    header("Location: index.php");
    exit();
}

if(!empty($_REQUEST['mode']))
{
    $mem = $_SESSION['memberId'];
    $title = $_REQUEST['title'];
    $date = $_REQUEST['date'];
    $from = $_REQUEST['from'];
    $till = $_REQUEST['till'];
    $location = $_REQUEST['location'];
    $desc = $_REQUEST['desc'];

    $tmpName=$_FILES['poster']['tmp_name'];
   
    if ( ($_FILES["poster"]["size"] < 2000000) )
    {
        if (!($_FILES["poster"]["error"]) )
        {
            $titShort= explode(" ",trim($title) );
            $titl = (string)$titShort[0];
            $posterName = $mem.$titl.rand(1,99999).".".end(explode(".",$_FILES["poster"]["name"]) );
            $tmpName=$_FILES['poster']['tmp_name'];
            
            move_uploaded_file($tmpName, "images/posters/".$posterName);
        } 
    }

     if ( ($_FILES["permissionLetter"]["size"] < 2000000) )
    {
        if (!($_FILES["permissionLetter"]["error"]) )
        {
            $titShort= explode(" ",trim($title) );
            $titl = (string)$titShort[0];
            $permissionLetterName = $mem.$titl.rand(1,99999).".".end(explode(".",$_FILES["permissionLetter"]["name"]) );
            $tmpName=$_FILES['permissionLetter']['tmp_name'];
            
            move_uploaded_file($tmpName, "images/permissionLetters/".$permissionLetterName);
        } 
    }

    
   
    $sql = "INSERT INTO event SET 
                    eventId = '',
                    memberId = '$mem',
                    title = '$title',
                    dat = '$date',
                    fromTime = '$from',
                    till = '$till',
                    location ='$location',
                    description = '$desc',
                    poster = '$posterName',
                    permission = '$permissionLetterName' " ; 
    
    $res = $mysqli->query($sql);

    if ($res)
    {
        $message = "Congratulations! Your event has been added successfully!";
        $_SESSION['message'] = $message;
        
        header ('Location: landing.php');
    }
}

?>
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

            <header></header>

            <div style="width: 532px; margin: auto;">
            <h1 style="margin-top: 40px;">Add details for the new event</h1>
            
            <form  method="POST" enctype="multipart/form-data" style="width:550px;">


                <input type="hidden" name="mode" value="1" />

                <!-- name = title -->
                <label class="formLabel"> Title </label> <br> <input type="text" name="title" id="eventTitle" style="margin-bottom: 10px;" required >
                <br/>

                <!-- name = date -->
                
                <label class="formLabel">Date:</label><input type="text" style="width: 112px; margin: 10px 18px 10px auto;" id="date" name="date" placeholder="Click to add" required>

                <!-- name :  from  -->
                <label class="formLabel">From:</label><input type="text" id="from" placeholder="HH:MM" pattern="[0-2][0-9]:[0-5][0-9]" title="Standard 24 hour clock" name="from" style="margin-right: 18px; width: 100px;" required>

                <!-- name : till -->
                <label class="formLabel" style="width: 35px;">Till:</label><input type="text" placeholder="HH:MM" pattern="[0-2][0-9]:[0-5][0-9]" title="Standard 24 hour clock" id="till" name="till" style="width: 100px;" required><br>
                
                <!-- name : location  -->
                <label class="formLabel" style="width: auto; margin: 10px 10px 10px auto;">Location:</label><input type="text" name="location" style="width: 258px;" required><br>

                <!-- name : desc -->
                <label class="formLabel" style="margin-top: 5px;">Description</label><br>
                <textarea cols="40" rows="8" name="desc" style="max-width: 496px; min-width: 496px; max-height:144px; font-family: Roboto, 'Segoe UI', 'Helvetica';"></textarea><br>

                <!-- name : poster -->
                <label class="formLabel1" style="margin-top: 5px;">Poster</label>
                <input type="file" onchange="validation(this.value)" id="poster"  style="font-size: 12px;" name="poster" required><br><br>

                <label class="formLabel1" style="margin-top: 5px;">Permission Letter</label>
                <input type="file" onchange="validation(this.value)" id="permissionLetter"  style="font-size: 12px;" name="permissionLetter" required><br>
                <div style="text-align:center;" >
                    <input type="submit" id="subBtn" value="Create Event">
                </div>
            </form>
            </div>
        <div class="push"></div></div>

        <div class="footer">
            <p style="margin-top: 7px;">Developed and maintained by the Computer Society of India, VIT University Chapter</p>
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
