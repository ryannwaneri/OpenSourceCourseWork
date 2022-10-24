<?php

 // initialize session and validate authentication
include_once('connect.php');
session_start();
if (!isset($_SESSION['authenticate'])) {
        echo "<h2 style='color:red;text-align:center;'>Direct access is not allowed. Redirecting....<h2>";
        header("refresh:3;url=./index.php");
        die();
    }
$loggedInUser = $_SESSION['username'];
$error = false;
if(isset($_POST['register'])){

    // below code use for sanitze use inputs

    $first_name = $_POST['first_name'];
    $first_name = htmlspecialchars($first_name);
    $first_name = strip_tags($first_name);
    
    $contact_no = $_POST['contact_no'];
    $contact_no = htmlspecialchars($contact_no);
    $contact_no = strip_tags($contact_no);
        
    $email = $_POST['email'];
    $email = htmlspecialchars($email);
    $email = strip_tags($email);
    
    $last_name = $_POST['last_name'];
    $last_name = htmlspecialchars($last_name);
    $last_name = strip_tags($last_name);
    
    
    // below code insert data into employee table
    
        $sql = "insert into employee(first_name, contact_no, email, last_name, owner) values ('$first_name', '$contact_no' ,'$email' ,'$last_name','$loggedInUser')";
        if(mysqli_query($conn, $sql)){
            $successMsg = 'Added new employee.';
        }
    

}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="./style/style.css">
</script>
</head>
<body class="align">
  <div class="grid align__item">
    <div class="register">
    <img class="site__logo" src="./images/logo.png" width="100" height="84">
      <h2>Add Employees</h2>
       <form class="form"  method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <?php
                    if(isset($successMsg)){
                 ?>
                        <div>
                            <span></span>
                            <?php echo $successMsg; ?>
                        </div>
                <?php
                    }
                ?>
                <table>
                       <tr> <td> <label>First Name</label></td>
                       	    <td> <div class="form__field"><input type="text" name="first_name" required="">
                                 </div> 
                            </td> 
                       </tr>
                       <tr> <td> <label>Last Name</label></td>
                       	    <td> <div class="form__field"><input type="text" name="last_name"  autocomplete="off" required="">
                                 </div> 
                            </td> 
                        </tr> 
                        <tr> <td> <label>Contact Number</label></td>
                       	    <td> <div class="form__field"><input  type="contact_no" name="contact_no" autocomplete="off" required="">
                                 </div> 
                            </td> 
                        </tr> 
                        <tr> <td> <label>Email</label></td>
                       	    <td> <div class="form__field"><input type="email" name="email" autocomplete="off" required="">
                                 </div> 
                            </td> 
                        </tr> 
                </table>
                <br>
                <div >
                    <center><input type="submit" name="register" value="Enter Employee" ></center>
                </div>
               
            </form>
             <a href="./display.php"><button >Display</button></a> 
                <br>
              <a href="./logout.php"><button>Log Out</button></a> 
  </div>

</body>
</html>
  
</body>
</html>
