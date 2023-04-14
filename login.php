<?php 

session_start();
if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit;
}
 
require_once "conn.php";
 
$regno = $password = "";
$username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["regno"]))){
        $username_err = "Please enter Reg-Number.";
    } else{
        $regno = trim($_POST["regno"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, fname,lname,email,regno,phone,county,hostel,room,gname,paid,fee,course, password FROM students WHERE regno = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $regno;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt,$id,$fname,$lname,$email,$reg,$phone,$county,$hostel,$room,$gname,$paid,$fee,$course, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $balance = $fee-$paid;

                            $_SESSION["reg_no"] = $fname;
                            $_SESSION['hostel']  = $hostel;
                            $_SESSION['room'] =$room;
                            $_SESSION["lname"] = $lname;
                            $_SESSION['email']  = $email;
                            $_SESSION['reg'] =$reg;
                            $_SESSION['phone'] = $phone;
                            $_SESSION['county'] = $county;
                            $_SESSION['balance'] = $balance;
                            $_SESSION['course'] = $course; 
                            $_SESSION['gname'] = $gname;                          
                            
                            header("location: portal.php");
                        } else{
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h5>Enter your Login Details</h5>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="registration">Reg Number:</label>
                    <span class="help-block"><?php echo $username_err; ?></span>
                    <input type="text" name="regno" placeholder="Registration Number" required>
                </div>
                <div class="form-group">
                    <label for="registration">Password:</label>
                    <span class="help-block"><?php echo $password_err; ?></span>
                    <input type="text" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="login" value="Let Me In" id="login">
                </div>
            </form>
            <p>Go Back Home? <span><a href="home.html">Home</a></span></p>
        </div>
    </div>
</body>
</html>