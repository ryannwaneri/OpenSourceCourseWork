<?php 

    // initialize session and validate authentication

    session_start();
    if (!isset($_SESSION['authenticate'])) {
        echo "<h2 style='color:red;text-align:center;'>Access Denied. Redirecting....<h2>";
        header("refresh:3;url=./index.php");
        die();
    }
    $loggedInUser = $_SESSION['username'];
    $msg = "";

    if(isset($_SESSION["successful_delete"]) && $_SESSION["successful_delete"] == true) {
      $msg = "Successful deletion";
      unset($_SESSION["successful_delete"]);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <title>Employees</title>
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="./style/table.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body class="">
  <div class="">
  	<div class="register">
    <h3><u>Employee Information Table</u></h3>
	<br>
  
<table>
	<tr><th >Employee ID</th> 
        <th>First Name</th> 
        <th>Last Name</th>
        <th>E-mail</th>
        <th>Contact</th>
	</tr>

  <!-- connect to database get display data from employee table -->
       <?php
       include_once('connect.php');
       $sql = "SELECT emp_id, first_name, last_name, email, contact_no FROM employee WHERE owner = '$loggedInUser'";
       $result = $conn-> query ($sql);
       if ($result-> num_rows > 0) {
    	   while ($row = $result -> fetch_assoc()) {
    		echo "<tr><td>".$row["emp_id"]."</td><td>". $row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["email"]."</td><td>".$row["contact_no"]."</td>
          <td><form action='remove.php' method='POST'><input type='hidden' name='id' value='".$row["emp_id"]."'><button class='delete' type='submit'>Delete</button></form></td></tr>";
    	   }
    	   echo "</table>";
       }else{
    	echo "No record found";
       }
       $conn->close();
       ?>
</table>
<?php if($msg): ?>
  <p style='font-size: 20px; margin-top: 30px; color: red;'><?php echo $msg; ?></p>
<?php endif; ?>

<br><br>
 <a href="./registration.php"><button>Add new Employee</button></a>  
 <br>
<br>
 <a href="./logout.php"><button>Log Out</button></a>
  	</div>
  </div>
</body>
</html>
