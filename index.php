$host = "localhost";

$user = "logger";

$password = "password";

$database = "temperatures";

//how many hours backwards you want results to be showing?

$hours = 12;

//make connection to database

$conn = mysqli_connect($host,$user,$password,temperatures);

if (!$conn){

die("connection failed: ".mysqli_connect_error());

}

echo"connected successfully";

//NOTE: if u want to show all entriesfrom currentdatein web page uncomment line below by removing//

?>

<html>

<head>

<title>Temperatures</title>

</head>

<body>

</body>

<table width="600" border="1" cellpadding="1" cellspacing="1" align ="center">

<tr>

<th>Date</th>

<th>Sensor</th>

<th>Temperature</th>

<th>Humidity</th>

</tr>

<?php

//$result =mysqli_query("SELECT * FROM temperaturedata;");

$result = mysqli_query($conn,"SELECT * FROM temperatures.temperaturedata WHERE dateandtime >=(NOW() - INTERVAL $hours HOUR)");

//$result="SELECT * FROM temperaturedata where date(dateandtime =curdate();";

if ($result ===FALSE){

die(mysqli_error());

}

//loop all rsults read from database and "draw" in web page

while($row = mysqli_fetch_assoc($result))

{

echo "<tr>";

echo "<td>".$row['dateandtime']."</td>";

echo '<td>'.$row["sensor"].'</td>';

echo '<td>'.$row["temperature"].'</td>';

echo '<td>'.$row["humidity"].'</td>';

echo "</tr>";

}

?>

</table>

//</body>

</html>

