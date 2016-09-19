<?php
    //Turn on error reporting
    ini_set('display_errors', 'On');
    //Connects to the database
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "beatoj-db", "dHdMIX4gvy4VC2dw", "beatoj-db");
    if($mysqli->connect_errno) {
        echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
    //echo "THIS WORKS";

if(!($stmt = $mysqli->prepare("INSERT INTO Pokemon(id, name, description) VALUES (?,?,?)"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("iss",$_POST['PokemonID'],$_POST['PokemonName'],$_POST['PokemonDescription']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
    echo "Added " . $stmt->affected_rows . " rows to Pokemon.";
}
?>
