<?php
    include("includes/config.php");
    
    if (isset($_POST["addDataSubmit"])) {
        $un = $_SESSION['userLoggedIn'];
        $pn = $_POST["phNo"];
        $mof = $_POST["MOF"];
        $cp = $_POST["crop"];
        $cp = ucfirst(strtolower($cp));
        $la = $_POST["landArea"];
        
        $status = mysqli_query($con, "INSERT INTO farmer_details values ('$un', '$pn', '$mof', '$cp', '$la')");
    }
    $user = $_SESSION['userLoggedIn'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add your Data</title>
    <link rel="stylesheet" type="text/css" href="assets/css/adddata.css">
    <style>

        .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  position: absolute;
  top: 250px;
  margin-left: 100px;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
}
        </style>
</head>
<body>
    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">  
            <h2 id="msg">Enter user details</h2>  
                <form id="loginform" action="" method="POST">
                    <?php echo $_SESSION['userLoggedIn']; ?>

                    <label for="phNo">Phone Number</label>
                    <input type="text" name="phNo" pattern="[1-9]{1}[0-9]{9}" placeholder="e.g. 1234567890" required><br>

                    <label for="MOF">Method of Farming</label>
                    <input type="text" name="MOF" placeholder="e.g. " required><br>

                    <label for="crop">Crop</label>
                    <input type="text" name="crop" placeholder="e.g. bartSimpson" required><br>

                    <label for="crop">Land Area</label>
                    <input type="text" name="landArea" placeholder="e.g. bartSimpson" required><br>

                    <button name="addDataSubmit">Submit</button>
                </form>
            </div>
        </div>
        <div id="loginquote">
            <form action="harvest_completed.php" method="POST">
                <button id="bt" name="harvest_complete" class="button button1">Harvest completed</button>
		</div>
    </div>
</body>
</html>