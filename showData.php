<!DOCTYPE html>
<html>
<head>
	<title>Table</title>
	<style>
		#c,#cx
		{
			position: relative;
			top: 1.5em;
		}
		#d
		{
			display: none;
		}
		#customers {
  			font-family: Arial, Helvetica, sans-serif;
  			border-collapse: collapse;
  			width: 100%;
			}	

		#customers td, #customers th {
  			border: 1px solid #ddd;
  			padding: 8px;
			}

		#customers tr:nth-child(even){background-color: #f2f2f2;}

		#customers tr:hover {background-color: #ddd;}

		#customers th {
  		padding-top: 12px;
  		padding-bottom: 12px;
  		text-align: left;
  		background-color: #04AA6D;
  		color: white;	
		}
		div 
		{
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
			font-size: 20px;
        }
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
	<?php
	include("includes/config.php");
    $row="";
	$sql4="SELECT * FROM farmer_details ";
	$res4=mysqli_query($con,$sql4);
	if($res4)
	{
		echo "<table id='customers'>";
		echo "<tr>";
		echo "<th>username</th>";
		echo "<th>phone_no</th>";
		echo "<th>MOF</th>";
		echo "<th>crop</th>";
		echo "<th>landarea</th>";
		echo "</tr>";
	    while($row = mysqli_fetch_assoc($res4))
	    {
	    	echo "<tr>";
	    	echo "<td class='t'>".$row["username"]."</td>";
	    	echo "<td class='t'>".$row["phone_no"]."</td>";
	    	echo "<td class='t'>".$row["MOF"]."</td>";
	    	echo "<td class='t'>".$row["crop"]."</td>";
	    	echo "<td class='t'>".$row["land_area"]."</td>";
	    	echo "</tr>";
	    }
	    echo "</table>";
	}
	?>
	<input type="button" class="button button1" value = "Show" onclick="FbotonOn()">
	<div id="d">
		<h2>Suggestion box</h2>
		<h4>The crop suggested for you is</h4>
		<p id="txt"></p>
	</div>
	<?php
	 	$sql5="SELECT * from min_crop where land_area = ( SELECT min(land_area) from min_crop)";
		$res5=mysqli_query($con,$sql5);
		mysqli_close($con);
	?>
	<script type="text/javascript">
		const divele = document.getElementById("d");
    	const para = document.getElementById("txt");
    	function FbotonOn() 
    	{ 

        	divele.style.display="block";
        	para.innerHTML="<?php 
								while($r = mysqli_fetch_assoc($res5))
								{
									echo $r["crop"];
								}	 
							?>";
		}
	</script>
</body>
</html>