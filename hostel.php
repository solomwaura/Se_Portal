<?php 
    include 'conn.php';
    
    session_start();

    if(!isset($_SESSION['reg_no'])){
        header("Location: login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="portal.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <h3>Student Portal</h3>
        </div>
        <div class="account">
            <h5><span>Welcome : </span><?php echo $_SESSION['reg_no']; ?></h5>
        </div>
    </div>
    <div class="admin-content">
        <div class="side-bar">
            <div class="side">
                <h4><a href="portal.php">Dashboard</a></h4>
            </div>
            <div class="side">
                <h4><a href="hostel.php">Hostel</a></h4>
            </div>
            <div class="side">
                <h4><a href="profile.php">My Details</a></h4>
            </div>
            
            <div class="side">
                <h3>Settings</h3>
                <p><a href="profile.php">Profile</a></p>
                <form action="logout.php" method="post">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>
           
            
        </div>
        <div class="content">
           
            <div class="courses">
                <div class="book">
                    <h4>Make a Room Reservation.</h4>
                    <form action="" method="post">
                        <fieldset>
                            <legend>Select Hostel</legend>
                            <select name="hostel" id="">
                                <option value="">--Select Hostel--</option>
                                <option value="victoria">Victoria</option>
                                <option value="yatta">Yatta</option>
                                <option value="Elementaita">Elementaita</option>
                                <option value="Turkana">Turkana</option>
                                <option value="Baringo">Baringo</option>
                            </select>
                        </fieldset>
                        .<div class="form-group">
                          <input type="submit" name="book" id="" class="form-book" />
                        </div>
                    </form>
                </div>
            
            </div>
        </div>
    </div>
</body>

</html>