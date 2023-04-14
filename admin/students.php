<?php include 'conn.php';

    session_start();

    if(!isset($_SESSION['admin'])){
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
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <h3>Admin Dashboard</h3>
        </div>
        <div class="account">
            <h5>Welcome Admin. <span><?php echo $_SESSION['fname']; ?></span></h5>
            <p><?php echo $_SESSION['admin']; ?></p>
        </div>
    </div>
    <div class="admin-content">
        <div class="side-bar">
            <div class="side">
                <h4><a href="index.php">Dashboard</a></h4>
            </div>
            <div class="side">
                <div class="dropdown">
                    <div class="dropdown-button">
                      <h3>Students</h3>
                    </div>
                    <div class="actions">
                      <ul>
                        <li><a href="studentRegister.php">Add Student</a></li>
                        <li><a href="students.php">View Students</a></li>
                      </ul>
                    </div>
                </div>
                
            </div>
            <div class="side">
                <div class="dropdown">
                    <div class="dropdown-button">
                      <h3>Courses</h3>
                    </div>
                    <div class="actions">
                        <ul>
                            <li><a href="./Add_course.php">Add Course</a></li>
                            <li><a href="courses.php">View Courses</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="side">
                <div class="dropdown">
                    <div class="dropdown-button">
                      <h3>Lecturers</h3>
                    </div>
                    <div class="actions">
                        <ul>
                            <li><a href="./Add_lecturer.php">Register Lecturer</a></li>'
                            <li><a href="lecturers.php">View Lecturers</a></li>
                        </ul>
                      
                      
                    </div>
                </div>
                
            </div>
            <div class="side">
                <div class="dropdown">
                    <div class="dropdown-button">
                      <h3>Admins</h3>
                    </div>
                    <div class="actions">
                        <ul>
                            <li> <a href="./Add_admin.php">Add Admins</a></li>
                            <li><a href="admins.php">View Admins</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="side">
                <h3>Settings</h3>
                <p>Profile</p>
                <form action="logout.php" method="post">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>
           
            
        </div>
        <div class="content">
          
            <div class="students">
                <h3>Enrolled Students</h3>
                <?php


                    // Select all users from the database
                    $sql = "SELECT * FROM students";
                    $result = mysqli_query($conn, $sql);

                    // Create a table to display the users
                    echo "<table>";
                    echo "<tr><th>ID</th><th> First Name</th><th> Last Name</th><th>Email</th><th> Phone</th><th> Hostel</th><th>Reg Number</th><th>Actions</th></tr>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['fname']."</td>";
                        echo "<td>".$row['lname']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['phone']."</td>";
                        echo "<td>".$row['hostel']."</td>";
                        echo "<td>".$row['regno']."</td>";
                        echo "<td><form method='post' action='edit.php'><input type='hidden' name='id' value='".$row['id']."'><input type='submit' value='Edit' class='edit'></form></td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                ?>

            </div>
        </div>
    </div>

</body>

</html>