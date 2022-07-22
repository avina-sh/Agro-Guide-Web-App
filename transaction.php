<?php
    include ("includes/config.php");

    if(isset($_POST["confirm"]))
    {
        $password = $_POST['Password'];
        $user = $_SESSION['userLoggedIn'];
        $remqty = $_SESSION['qty_remaining'];
        $cp = $_SESSION['crop_ordered'];
        $price = $_SESSION['price'];

        $query = mysqli_query($con, "select * from consumer_login where username = '$user'");
        $row = mysqli_fetch_assoc($query);
        $pwd = md5($password);

        if($pwd==$row["password"])
        {
            $cropQty = mysqli_query($con, "select sum(qty_avail) as ttl from product group by crop having crop = '$cp'");
            $var0 = mysqli_fetch_assoc($cropQty);
            $totalCrop = $var0['ttl'];

            $cropQty = mysqli_query($con, "select qty_avail as qty, username as fuser from product where crop = '$cp'");
            while ($var1 = mysqli_fetch_assoc($cropQty)) {
                $userQty = $var1['qty'];
                $respAmt = $userQty/$totalCrop * $price;
                $farmerName = $var1['fuser'];

                mysqli_query($con, "insert into farmer_acc (c_name, f_name, amount) values('$user', '$farmerName', $respAmt)");
            }

            $query = mysqli_query($con,"update warehouse set quantity = $remqty where crop = '$cp'");
        }
        else
        {
            echo "Failed";
        }
    }
?>
<!doctype html>
<head>
    <title>Payment</title>
    <style>
    #customers {
  			font-family: Arial, Helvetica, sans-serif;
  			border-collapse: collapse;
  			width: 100%;
			}	

            #customers td, #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even){
                background-color: #f2f2f2;
            }

            #customers tr:hover {
                background-color: #ddd;
            }

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #04AA6D;
                color: white;
            }
            input[type=text]{
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            }

            input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            }

            input[type=submit]:hover {
            background-color: #45a049;
            }

            div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            }
        </style>    
</head>
<body>
    <?php
            echo "<table id='customers'>";
            echo "<tr>";
            echo "<th>Crop ordered</th>";
            echo "<th> Crop Quantity</th>";
            echo "<th>Quantity remaining</th>";
            echo "<th>Price</th>";
            echo "</tr>";
            echo "<tr>";
            echo "<td class='t'>".$_SESSION['crop_ordered']."</td>";
            echo "<td class='t'>".$_SESSION['crop_quantity']."</td>";
            echo "<td class='t'>".$_SESSION['qty_remaining']."</td>";
            echo "<td class='t'>".$_SESSION['price']."</td>";
            echo "</tr>";
            echo "</table>";
    ?>
    <div>
    <form action="transaction.php" method="POST">
        <label for="Password">Enter password to proceed Payment</label>
        <input type="password" name="Password">
        <button type="submit" name="confirm">Confirm</button>
    </form>
    </div>

    
</body>