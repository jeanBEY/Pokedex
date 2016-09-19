<?php
    //Turn on error reporting
    ini_set('display_errors', 'On');
    //Connects to the database
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "beatoj-db", "dHdMIX4gvy4VC2dw", "beatoj-db");
    if($mysqli->connect_errno) {
        echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
    //echo "THIS WORKS";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<div>
	<table>
		<tr>
			<td>Pokedex</td>
		</tr>
		<tr>
            <td>Base HP</td>
            <td>Pokemon</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT Base_hp.hp, Pokemon.name FROM Base_hp INNER JOIN pokemon_base ON Base_hp.basehp_id = pokemon_base.bid INNER JOIN Pokemon ON Pokemon.id = pokemon_base.pid  WHERE Base_hp.basehp_id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['BaseHP']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($hp, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $hp . "\n</td>\n<td>\n" . $name .  "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>

