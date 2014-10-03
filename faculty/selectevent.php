<?php
    session_start();
    include ("lib/connection.php");
    
    if (empty($_SESSION['faculty'])) 
    {
        header("Location: index.php");
        exit();
    }

    $member = $_SESSION['faculty'];
    $member = mysqli_real_escape_string($mysqli, $member);

    $sqlQuery = "SELECT memberID FROM faculty WHERE id = '$member'";
    $resQuery = $mysqli->query($sqlQuery);
    $dataQuery = $resQuery->fetch_array();
    $memberID = $dataQuery['memberID'];
    $memberArray = array();

    if ($memberID == 999)
    {
        $sqlQuery = "SELECT memberID FROM multipleFaculty WHERE id = '$member'";
        $resQuery = $mysqli->query($sqlQuery);
        while ($dataQuery=$resQuery->fetch_array())
        {
            $memberArray[] = $dataQuery[0];
        }
    }
    else
        $memberArray[] = $memberID;    
    $string = "(";
    $size = sizeof($memberArray);
    $string = $string . $memberArray[--$size];
    
    while($size--)
        $string = $string . "," . $memberArray[$size];
    
    $string = $string.")";

    $sql = "SELECT * FROM event WHERE verificationStatus = 'yes' OR verificationStatus = 'mid' and memberId IN $string ";


    $res = $mysqli->query($sql);
    
    if (!$res)
    {
        echo $mysqli->error;
    }
    $row_cnt= $res->num_rows;

    //$option = $res->fetch_array();
                            
    


?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Events Portal</title>
        <link rel="stylesheet" type="text/css" href="eventaddmodStyle.css">
    </head>
    <body>
        
        <div class="wrapper">
            <script src="home.js"></script>
            <header></header>
            
            <div style="width: 430px; margin: auto;">
                <h2>Select the event you want to view. </h2>
                <form style="width: 400px; position: static;" method = "POST" action="view.php">
                    

                    <?php 
                        while($data = $res->fetch_array()) 
                        {
                            $title = $data['title'];
                            $id = $data['eventId'];
                    ?>
                        <div class="radioDiv"><input type="radio" name="event" value="<?php echo $id; ?>" id="list1" class="radios"><label class="radioLabel"><?php echo $title; ?></label><br></div>
                    <?php
                        }
                        if ($row_cnt == 0)
                        {
                            echo "There are no events to display!";
                        }
                    ?>

                    <input type="submit" id="subBtn" style="margin: 10px auto 10px 100px; " value="View">
                </form>
            </div>

        <div class="push"></div></div>

        <div class="footer">
             <p style="margin-top: 7px;"></p>
        </div>

    </body>
</html>
