<html>
<head>
	<title>AG</title>
	<link rel="stylesheet" type="text/css" href="assets/css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form action="showData.php" method="POST">
					<div id="showData">
						<h2>Click here to view data</h2>
						<button name="showButton" id="bt1">show data</button>
					</div>
				</form>
				<form action="addData.php" method="POST">
					<div id="addData">
						<h2>Click here to add data</h2>
						<button name="addButton" id="bt2">add data</button>
					</div>
				</form>
			</div>
		</div>
		<div id="loginQuote">
			<h1>Welcome to AgroGuide</h1>
			<h2>Here's are step you need to know</h2>
			<ul>
				<li>Click show data <br>to list the records</li>
				<li>Click add data <br>to insert a record</li>
				<li>Click alter to alter <br>your records(present in add data)</li>
				<li>Click suggestions to<br> get crop suggestions</li>
			</ul>
		</div>
	</div>
</body>
</html>