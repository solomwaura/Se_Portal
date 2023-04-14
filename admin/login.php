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
 
    if(empty(trim($_POST["admin_number"]))){
        $username_err = "Please enter Reg-Number.";
    } else{
        $regno = trim($_POST["admin_number"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, fname,email,admin_id, password FROM admins WHERE admin_id = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $regno;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt,$id,$fname,$email,$admin_id, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $balance = $fee-$paid;

                            $_SESSION["admin"] = $admin_id;
                            $_SESSION["fname"] = $fname;
                            $_SESSION['email']  = $email;                         
                            
                            header("location: index.php");
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
    <title>Admin</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h3>Admin Login Details</h3>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="registration">Admin Number:</label>
                    <input type="text" name="admin_number" placeholder="Registration Number" required>
                </div>
                <div class="form-group">
                    <label for="registration">Password:</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="login" value="Let Me In" id="login">
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>