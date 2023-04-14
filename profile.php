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
    <link rel="stylesheet" href="profile.css">
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
                <?php
                    $course = $_SESSION['course'];
                    $sql = "SELECT id, c_name,unit_code,school FROM courses WHERE course_id = ?";

                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $course);
                        
                        $course = $_SESSION['course'];
                        
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_store_result($stmt);
                            
                            if(mysqli_stmt_num_rows($stmt) == 1){                    
                                mysqli_stmt_bind_result($stmt,$id,$cname,$code,$school);
                                if(mysqli_stmt_fetch($stmt)){
        
                                    $_SESSION["c_name"] = $cname;
                                    $_SESSION['code']  = $code;
                                    $_SESSION['school'] = $school;                          
                                        
                                  
                                }
                            } else{
                                echo "No Courses.";
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }
                ?>
                <div class="my-profile">
                    <div class="avatar">
                        <div class="avatar-img">
                            <img src="./images/git.png" alt="">
                            
                        </div>
                        <h5><span>Welcome : </span><?php echo $_SESSION['reg_no']; ?></h5>
                    </div>
                    <div class="my-details">
                        <div class="personal">
                            <h4>Personal Details</h4>
                            <h5>First Name : <span><?php echo $_SESSION['reg_no']; ?></span></h5>
                            <h5>Last Name : <span><?php echo $_SESSION['lname']; ?></span></h5>
                            <h5>Email : <span><?php echo $_SESSION['email']; ?></span></h5>
                            <h5>Phone : <span><?php echo $_SESSION['phone']; ?></span></h5>
                            <h5>County : <span><?php echo $_SESSION['county']; ?></span></h5>
                        </div>
                        <div class="school">
                            <h4>School Details</h4>
                            <h5>Registration Number : <span><?php echo $_SESSION['reg']; ?></span></h5>
                            <h5>School : <span><?php echo $_SESSION['school']; ?></span></h5>
                            <h5>Course : <span><?php echo $_SESSION['reg']; ?></span></h5>
                            <h5>Hostel : <span><?php echo $_SESSION['hostel']; ?></span></h5>
                            <h5>Current Year : <span>2</span></h5>
                            <h5>Year of Admission : <span>2021</span></h5>
                        </div>
                        <div class="others">
                            <h4>Other Details</h4>
                            <h5>Gurdian 1 Name : <span><?php echo $_SESSION['gname']; ?></span></h5>
                            <h5>Phone Number : <span><?php echo $_SESSION['phone']; ?></span></h5>
                            <h5>Gurdian Email : <span><?php echo $_SESSION['email']; ?></span></h5>
                            <h5>Gurdian 2 Name : <span><?php echo $_SESSION['gname']; ?></span></h5>
                            <h5>Phone Number : <span><?php echo $_SESSION['phone']; ?></span></h5>
                            <h5>Gurdian Email : <span><?php echo $_SESSION['email']; ?></span></h5>
                        </div>
                    </div>
                </div>
                
                
                 

            </div>
        </div>
    </div>

</body>

</html>