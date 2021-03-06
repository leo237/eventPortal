<?php
    session_start();
    include ("lib/connection.php");
    
    if (empty($_SESSION['dsw'])) 
    {
        header("Location: index.php");
        exit();
    }

    $mem = $_SESSION['dsw'];
    $mem = mysqli_real_escape_string($mysqli, $mem);

    
    $sql = "SELECT * FROM event WHERE verificationStatus = 'mid' ";

    $res = $mysqli->query($sql);
    
    if (!$res)
    {
        echo $mysqli->error;
    }     
    $row_cnt= $res->num_rows;                       

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

            <header></header>
            <script src="home.js"></script>
            
            <div style="width: 430px; margin: auto;">
                <h2>Select Event</h2>
                <form style="width: 400px; position: static;" method = "POST" action="screenevent.php">
                    

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

                    <input type="submit" id="subBtn" style="margin: 10px auto 10px 100px; " value="Screen">
                </form>
            </div>

        <div class="push"></div></div>

        <div class="footer">
             <p style="margin-top: 7px;"></p>
        </div>

    </body>
</html>
