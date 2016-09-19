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
            <td>Move</td>
            <td>Pokemon</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT Move.move_name, Pokemon.name FROM Move INNER JOIN pokemon_move ON Move.move_id = pokemon_move.mid INNER JOIN Pokemon ON Pokemon.id = pokemon_move.pid  WHERE Move.move_id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['Move']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($move_name, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $move_name . "\n</td>\n<td>\n" . $name .  "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>

