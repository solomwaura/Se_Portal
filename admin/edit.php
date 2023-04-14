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
            <div class="courses">
            <?php


                // Check if form was submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Get the user's ID from the form data
                    $id = $_POST["id"];

                    // Retrieve the user's current information from the database
                    $sql = "SELECT * FROM students WHERE id = '".$id."'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $fname = $row["fname"];
                        $lname = $row["lname"];
                        $phone = $row["phone"];
                        $email = $row["email"];
                        $hostel = $row["fname"];
                        $room = $row["email"];
                        $gname = $row["gname"];
                        $gphone = $row["gphone"];
                        $county = $row["county"];
                        $regno = $row["regno"];

                        // Check if form was submitted with updated user information
                        if (isset($_POST["name"]) && isset($_POST["email"])) {
                            $name = $_POST["name"];
                            $email = $_POST["email"];

                            // Update the user's information in the database
                            $sql = "UPDATE students SET name = '".$name."', email = '".$email."' WHERE id = '".$id."'";
                            mysqli_query($conn, $sql);

                            // Redirect the user back to the table of users
                            header("Location: edit.php");
                        }
                    }
                }


            ?>

    <h1>Edit Student</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name"> First Name:</label>
        <input type="text" name="name" value="<?php echo $fname; ?>"><br>
        <label for="name"> Last Name:</label>
        <input type="text" name="name" value="<?php echo $lname; ?>"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>"><br>
        <label for="name">Phone:</label>
        <input type="text" name="name" value="<?php echo $phone; ?>"><br>
        <label for="email">Hostel:</label>
        <input type="email" name="email" value="<?php echo $hostel; ?>"><br>
        <label for="email">Room Number:</label>
        <input type="email" name="email" value="<?php echo $room; ?>"><br>
        <label for="name"> Guardian Name:</label>
        <input type="text" name="name" value="<?php echo $gname; ?>"><br>
        <label for="name"> Guardian Phone:</label>
        <input type="text" name="name" value="<?php echo $gphone; ?>"><br>
        <label for="email">County:</label>
        <input type="email" name="email" value="<?php echo $county; ?>"><br>
        <label for="name">Reg Number:</label>
        <input type="text" name="name" value="<?php echo $regno; ?>"><br>
        <input type="submit" value="Update Changes" class="editting">
    </form>


            </div>
        </div>
    </div>

</body>

</html>