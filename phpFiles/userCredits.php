<?php

//config inclusion session starts
include("config.php");
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") {


    $amount = (float)$_POST['amount'];
    $person_id = $_SESSION['person_id'];
    
    if($amount <= 0) {
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Amount of credit you are trying to add is equal to 0 or less.');
        window.location.href = 'userCredits.php'; 
        </script>";
    }
    else {
        $query = "UPDATE person SET credits = credits + " .$amount  . " WHERE person_id = " .$person_id;
        $res = mysqli_query($db ,$query);
        if($res) {
            echo "<script LANGUAGE='JavaScript'>
            window.alert('Your credits are updated.');
            window.location.href = 'userCredits.php'; 
            </script>";
        }
        else {
            echo "<script LANGUAGE='JavaScript'>
            window.alert('Your credits are NOT updated.');
            window.location.href = 'userCredits.php'; 
            </script>";
        }
    }


    $sql = "INSERT INTO ask(publisher_id, developer_id, ask_game_name, ask_game_genre, ask_game_desc) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "iisss", $publisherId, $developerId, $gameName, $gameGenre, $gameDesc);
    mysqli_stmt_execute($stmt);
    //header("location: developerWelcome.php");
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        #centerwrapper { text-align: center; margin-bottom: 10px; }
        #centerdiv { display: inline-block; }
        /* Navbar container */
        .navbar {
        overflow: hidden;
        background-color: #333;
        font-family: Arial;
        }

        h1 { 
        display: block;
        font-size: 3em;
        margin-top: 0.67em;
        margin-bottom: 0.67em;
        margin-left: 0;
        margin-right: 0;
        font-weight: bold;
        }

        /* Links inside the navbar */
        .navbar a {
        float: left;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        }
        /* Add a red background color to navbar links on hover */
        .navbar a:hover, .dropdown:hover .dropbtn {
        background-color: black;
        }

    </style>
</head>
<body>
    
    <div class="container">
        
        <nav class="navbar navbar-inverse bg-primary navbar-fixed-top">
        
            <div class="container-fluid">
                <div class="navbar-header">
                    <h4 class="navbar-text">User <?php echo htmlspecialchars($_SESSION['nick_name']); ?></h4>

                </div>
                <a href="userWelcome.php">Home</a>
                <a href="userLibrary.php">Library</a>
                <a href="userStore.php">Store</a>
                <a href="userCheckUpdates.php">Check Updates</a>
                <a href="userCheckMods.php">Mods</a>
                <a href="followCurators.php">Follow Curators</a>
                <a href="userRefund.php">Refund</a>
                <a href="userRefundHistory.php">Refund History</a>
                <a href="userShopHistory.php">Shop History</a>
                <?php
                    $query = "SELECT credits FROM person WHERE person_id = " .$_SESSION['person_id'];
                    $res = mysqli_query($db, $query);
                    $row = mysqli_fetch_array($res);
                    $credit = $row['credits'];
                    echo "<a href='userCredits.php'>Credit : $credit TL </a>";
                ?>
                
                <div class="navbar-right">
                    <a href="logout.php">Log Out</a>
                </div>
    </div>
            </div>
            
        </nav>

        
        <div id="centerwrapper">
            <div id="centerdiv">
                <br><br>
                <h1>Add Credits</h1>

                <form id="creditForm" action="" method="post">

                    <div class="form-group">
                        <label>Amount of Credits</label>
                        <div class="form-inline">
                            <input type="text" name="amount" class="form-control" id="amount"> 
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>

                    </div>     
                </form>                 
  
            </div>
        </div>
    </div>


</body>
</html>