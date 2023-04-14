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
            <div class="widgets">
                <div class="widget">
                    <h5>My GPA</h5>
                    <p>Points : <span>201</span></p>
                    <p>Class : <span>Upper Class</span></p>
                </div>
                <div class="widget">
                    <h5>Hostel</h5>
                    <p><?php echo $_SESSION['hostel']; ?></p>
                    <p>Room Number: <span><?php echo $_SESSION['room']; ?></span></p>
                </div>
                <div class="widget">
                    <h5>Semester Status</h5>
                    <p>status :<span> Reported</span></p>
                    <p>Sem 2 : <span>2022/2023</span></p>
                </div>
                <div class="widget">
                    <h5>Fee Balance</h5>
                    <p> <span>KSH : </span> <?php echo $_SESSION['balance']; ?></p>
                    <h6>Semester : <span>2 2022/2023</span></h6>
                </div>
            </div>
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
                <h3>School of : <?php echo $_SESSION['school']; ?> </h3>
                <h3>My Units</h3>
                <table>
                    <thead>
                        <tr>
                            <td>Unit Code</td>
                            <td>Unit Name</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $_SESSION['code']; ?> </td>
                            <td><?php echo $_SESSION['c_name']; ?> </td>
                        </tr>
                    </tbody>
                </table>
                 

            </div>
        </div>
    </div>
    <script>
        var dropdownButton = document.querySelector(".dropdown-button");
        var dropdownContent = document.querySelector(".dropdown-content");
    
        dropdownButton.addEventListener("click", function() {
            dropdownContent.classList.toggle("show");
        });
    
    </script>
</body>

</html>