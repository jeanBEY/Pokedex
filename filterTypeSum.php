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
            <td>Type ID</td>
            <td>Pokemon</td>
		</tr>
			<?php
				if(!($stmt = $mysqli->prepare("SELECT Type.type_name, Pokemon.name FROM Type INNER JOIN pokemon_type ON Type.type_id = pokemon_type.tid INNER JOIN Pokemon ON Pokemon.id = pokemon_type.pid  WHERE Type.type_id = ?"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!($stmt->bind_param("i",$_POST['Type']))){
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($type_name, $name)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo "<tr>\n<td>\n" . $type_name . "\n</td>\n<td>\n" . $name . "\n</td>\n</tr>";
				}

				$stmt->close();
			?>

			<?php
				if(!($stmt = $mysqli->prepare("SELECT COUNT(Pokemon.name) AS count FROM Pokemon INNER JOIN pokemon_type ON Pokemon.id = pokemon_type.pid INNER JOIN Type ON Type.type_id = pokemon_type.tid WHERE Type.type_id = ?"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!($stmt->bind_param("i",$_POST['Type']))){
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($count)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo "<tr>\n<td>\n" . "Total: " . "\n</td>\n<td>\n" . $count . "\n</td>\n</tr>";
				}

				$stmt->close();
			?>
	</table>
</div>

</body>
</html>

