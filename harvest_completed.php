<?php
    include("includes/config.php");
    $user = $_SESSION['userLoggedIn'];

    $cropQuery = mysqli_query($con, "select * from product where username = '$user';");
    $row = mysqli_fetch_assoc($cropQuery);
    $cp = $row['crop'];
    if (isset($_POST['pnqReport'])){
        $price = (int)$_POST['price'];
        $quantity = (int)$_POST['qnty'];

        $query = mysqli_query($con, "select * from product where username = '$user' and crop = '$cp';");

        if (mysqli_num_rows($query) == 1) {
            $query2 = mysqli_query($con, "update product set price = $price, qty_avail = $quantity where username = '$user';");
        }
    }

    $res=mysqli_query($con,"SELECT crop as crop,sum(qty_avail) as qty from product group by crop");

    while($row = mysqli_fetch_assoc($res))
    {
        $Wcrop = $row["crop"];
        $totalQty = $row["qty"];
        $q = mysqli_query($con, "select * from warehouse where crop = '$Wcrop'");

        if (mysqli_num_rows($q) > 0) {
            mysqli_query($con, "update warehouse set quantity = $totalQty where crop = '$Wcrop'");
        }
        else {
            mysqli_query($con, "insert into warehouse values('$Wcrop', $totalQty)");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Feed in details</title>
        <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    </head>
    <body>
    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form action="harvest_completed.php" method="POST">
                    <h2 style="color:blue;">Harvest details</h2>
                    <p><?php echo $cp; ?></p>
                    <label for="price">price</label>
                    <input type="text" name="price"><br>
                    <label for="qnty">Quantity being provided</label>
                    <input type="text" name="qnty"><br>
                    <input type="submit" value="Submit" name="pnqReport">
                </form>
            </div>
        </div>
    </div>            
    </body>
</html>