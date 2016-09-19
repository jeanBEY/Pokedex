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
            <td>ID</td>
            <td>Name</td>
            <td>Description</td>
            <td>Type</td>
            <td>Base HP</td>
            <td>Evolutions</td>
            <td>Move</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT Pokemon.id, Pokemon.name, Pokemon.description, Type.type_name, Base_hp.hp, Evolutions.evolution_number, Move.move_name FROM Pokemon INNER JOIN pokemon_type ON Pokemon.id = pokemon_type.pid INNER JOIN Type ON pokemon_type.tid = Type.type_id INNER JOIN pokemon_base ON pokemon_base.pid = Pokemon.id INNER JOIN Base_hp ON Base_hp.basehp_id = pokemon_base.bid INNER JOIN pokemon_evolution ON pokemon_evolution.pid = Pokemon.id INNER JOIN Evolutions ON Evolutions.evolution_id = pokemon_evolution.eid INNER JOIN pokemon_move ON pokemon_move.pid = Pokemon.id INNER JOIN Move ON Move.move_id = pokemon_move.mid WHERE Pokemon.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['Pokemon']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name, $description, $type_name, $hp, $evolution_number, $move_name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $description . "\n</td>\n<td>\n" . $type_name . "\n</td>\n<td>\n" . $hp . "\n</td>\n<td>\n" . $evolution_number . "\n</td>\n<td>\n" . $move_name . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>

