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

<!--SHOW EVERYTHING!-->

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
            <td>Move Description</td>
            <td>Move Strength</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT Pokemon.id, Pokemon.name, Pokemon.description, Type.type_name, Base_hp.hp, Evolutions.evolution_number, Move.move_name, Move.description, Move.strength FROM Pokemon INNER JOIN pokemon_type ON Pokemon.id = pokemon_type.pid INNER JOIN Type ON pokemon_type.tid = Type.type_id INNER JOIN pokemon_base ON pokemon_base.pid = Pokemon.id INNER JOIN Base_hp ON Base_hp.basehp_id = pokemon_base.bid INNER JOIN pokemon_evolution ON pokemon_evolution.pid = Pokemon.id INNER JOIN Evolutions ON Evolutions.evolution_id = pokemon_evolution.eid INNER JOIN pokemon_move ON pokemon_move.pid = Pokemon.id INNER JOIN Move ON Move.move_id = pokemon_move.mid GROUP BY Pokemon.id"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name, $description, $type_name, $hp, $evolution_number, $move_name, $move_description, $move_strength)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $description . "\n</td>\n<td>\n" . $type_name . "\n</td>\n<td>\n" . $hp . "\n</td>\n<td>\n" . $evolution_number . "\n</td>\n<td>\n" . $move_name . "\n</td>\n<td>\n" . $move_description . "\n</td>\n<td>\n" . $move_strength . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<h2>TABLES</h2>

<!--SHOW POKEMON TABLE!-->

<div>
    <table>
        <tr>
            <td>Pokemon TABLE</td>
        </tr>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Description</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT * FROM Pokemon"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name, $description)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $description . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<!--SHOW TYPE TABLE!-->

<div>
    <table>
        <tr>
            <td>Type TABLE</td>
        </tr>
        <tr>
            <td>ID</td>
            <td>Name</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT * FROM Type"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($type_id, $type_name)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $type_id . "\n</td>\n<td>\n" . $type_name . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<!--SHOW BASE_HP TABLE!-->

<div>
    <table>
        <tr>
            <td>Base_hp TABLE</td>
        </tr>
        <tr>
            <td>ID</td>
            <td>HP</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT * FROM Base_hp"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($basehp_id, $hp)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $basehp_id . "\n</td>\n<td>\n" . $hp . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<!--SHOW EVOLUTIONS TABLE!-->

<div>
    <table>
        <tr>
            <td>Evolutions TABLE</td>
        </tr>
        <tr>
            <td>ID</td>
            <td>Evolutions Left</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT * FROM Evolutions"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($evolution_id, $evolution_number)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $evolution_id . "\n</td>\n<td>\n" . $evolution_number . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<!--SHOW MOVE TABLE!-->

<div>
    <table>
        <tr>
            <td>Move TABLE</td>
        </tr>
        <tr>
            <td>ID</td>
            <td>Move Name</td>
            <td>Move Description</td>
            <td>Move Strength</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT * FROM Move"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($move_id, $move_name, $description, $strength)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $move_id . "\n</td>\n<td>\n" . $move_name . "\n</td>\n<td>\n" . $description . "\n</td>\n<td>\n" . $strength . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<!--SHOW POKEMON_TYPE TABLE!-->

<div>
    <table>
        <tr>
            <td>pokemon_type TABLE</td>
        </tr>
        <tr>
            <td>Pokemon ID</td>
            <td>Type ID</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT * FROM pokemon_type"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($pid, $tid)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $pid . "\n</td>\n<td>\n" . $tid . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<!--SHOW POKEMON_BASE TABLE!-->

<div>
    <table>
        <tr>
            <td>pokemon_base TABLE</td>
        </tr>
        <tr>
            <td>Pokemon ID</td>
            <td>Base HP ID</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT * FROM pokemon_base"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($pid, $bid)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $pid . "\n</td>\n<td>\n" . $bid . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<!--SHOW POKEMON_EVOLUTIONS TABLE!-->

<div>
    <table>
        <tr>
            <td>pokemon_evolution TABLE</td>
        </tr>
        <tr>
            <td>Pokemon ID</td>
            <td>Evolution ID</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT * FROM pokemon_evolution"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($pid, $eid)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $pid . "\n</td>\n<td>\n" . $eid . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<!--SHOW POKEMON_MOVE TABLE!-->

<div>
    <table>
        <tr>
            <td>pokemon_move TABLE</td>
        </tr>
        <tr>
            <td>Pokemon ID</td>
            <td>Move ID</td>
        </tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT * FROM pokemon_move"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($pid, $mid)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $pid . "\n</td>\n<td>\n" . $mid . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>
<br>

<h2>ADD</h2>

<!--ADD TO POKEMON TABLE!-->

<div>
    <form method="post" action="addpokemon.php"> 

    <fieldset>
        <legend>Add to Pokemon table</legend>
                    <fieldset>
                        <p>ID (above 100): <input type="text" name="PokemonID" /></p>
                        <p>Pokemon Name: <input type="text" name="PokemonName" /></p>
                        <p>Description: <input type="text" name="PokemonDescription" /></p>
                    </fieldset>
<!--
!-->

    </fieldset>
    <p><input type="submit" /></p>
    </form>
</div>

<!--ADD TO TYPE TABLE!-->

<div>
    <form method="post" action="addtype.php"> 

    <fieldset>
        <legend>Add to Type table</legend>
                    <fieldset>
                        <p>Type Name: <input type="text" name="TypeName" /></p>
                    </fieldset>

    </fieldset>
    <p><input type="submit" /></p>
    </form>
</div>

<!--ADD TO BASE_HP TABLE!-->

<div>
    <form method="post" action="addbase_hp.php"> 

    <fieldset>
        <legend>Add to Base_hp table</legend>
                    <fieldset>
                        <p>HP: <input type="text" name="Base_HP" /></p>
                    </fieldset>

    </fieldset>
    <p><input type="submit" /></p>
    </form>
</div>

<!--ADD TO EVOLUTIONS TABLE!-->

<div>
    <form method="post" action="addevolutions.php"> 

    <fieldset>
        <legend>Add to Evolutions table</legend>
                    <fieldset>
                        <p>Evolutions Left: <input type="text" name="Evolutions_Left" /></p>
                    </fieldset>

    </fieldset>
    <p><input type="submit" /></p>
    </form>
</div>

<!--ADD TO MOVE TABLE!-->

<div>
    <form method="post" action="addmove.php"> 

    <fieldset>
        <legend>Add to Move table</legend>
                    <fieldset>
                        <p>Move Name: <input type="text" name="MoveName" /></p>
                        <p>Move Description: <input type="text" name="MoveDescription" /></p>
                        <p>Move Strength: <input type="text" name="MoveStrength" /></p>
                    </fieldset>

    </fieldset>
    <p><input type="submit" /></p>
    </form>
</div>

<!--ADD TO POKEMON_TYPE TABLE!-->

<div>
    <form method="post" action="addpokemon_type.php"> 

    <fieldset>
            <legend>Add to pokemon_type table</legend>
            <p>Pokemon: </p>
            <select name="PokemonName">
                <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM Pokemon"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $name)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                }
                $stmt->close();
                ?>
            </select>

            <p>Type: </p>
            <select name="PokemonType">
                <?php
                if(!($stmt = $mysqli->prepare("SELECT type_id,type_name FROM Type"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($type_id, $type_name)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $type_id . ' "> ' . $type_name . '</option>\n';
                }
                $stmt->close();
                ?>
            </select>

        </fieldset>

    <p><input type="submit" /></p>
    </form>
</div>

<!--ADD TO POKEMON_BASE TABLE!-->

<div>
    <form method="post" action="addpokemon_base.php"> 

    <fieldset>
            <legend>Add to pokemon_base table</legend>
            <p>Pokemon: </p>
            <select name="PokemonName">
                <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM Pokemon"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $name)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                }
                $stmt->close();
                ?>
            </select>

            <p>Base HP: </p>
            <select name="PokemonBaseHP">
                <?php
                if(!($stmt = $mysqli->prepare("SELECT basehp_id, hp FROM Base_hp"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($basehp_id, $hp)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $basehp_id . ' "> ' . $hp . '</option>\n';
                }
                $stmt->close();
                ?>
            </select>
            
        </fieldset>

    <p><input type="submit" /></p>
    </form>
</div>

<!--ADD TO POKEMON_EVOLUTION TABLE!-->

<div>
    <form method="post" action="addpokemon_evolution.php"> 

    <fieldset>
            <legend>Add to pokemon_evolution table</legend>
            <p>Pokemon: </p>
            <select name="PokemonName">
                <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM Pokemon"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $name)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                }
                $stmt->close();
                ?>
            </select>

            <p>Evolutions Left: </p>
            <select name="PokemonEvolution">
                <?php
                if(!($stmt = $mysqli->prepare("SELECT evolution_id, evolution_number FROM Evolutions"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($evolution_id, $evolution_number)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $evolution_id . ' "> ' . $evolution_number . '</option>\n';
                }
                $stmt->close();
                ?>
            </select>
            
        </fieldset>

    <p><input type="submit" /></p>
    </form>
</div>

<!--ADD TO POKEMON_MOVE TABLE!-->

<div>
    <form method="post" action="addpokemon_move.php"> 

    <fieldset>
            <legend>Add to pokemon_move table</legend>
            <p>Pokemon: </p>
            <select name="PokemonName">
                <?php
                if(!($stmt = $mysqli->prepare("SELECT id, name FROM Pokemon"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($id, $name)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                }
                $stmt->close();
                ?>
            </select>

            <p>Move: </p>
            <select name="PokemonMove">
                <?php
                if(!($stmt = $mysqli->prepare("SELECT move_id, move_name FROM Move"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!$stmt->bind_result($move_id, $move_name)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while($stmt->fetch()){
                    echo '<option value=" '. $move_id . ' "> ' . $move_name . '</option>\n';
                }
                $stmt->close();
                ?>
            </select>
            
        </fieldset>

    <p><input type="submit" /></p>
    </form>
</div>

<h2>SEARCH/FILTER</h2>

<!--FILTER BY POKEMON!-->

<div>
    <form method="post" action="filterPokemon.php">
        <fieldset>
            <legend>Filter By Pokemon</legend>
                <select name="Pokemon">
                    <?php
                    if(!($stmt = $mysqli->prepare("SELECT id, name FROM Pokemon"))){
                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }

                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    if(!$stmt->bind_result($id, $name)){
                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    while($stmt->fetch()){
                     echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                    }
                    $stmt->close();
                    ?>
                </select>
        </fieldset>
        <input type="submit" value="Run Filter" />
    </form>
</div>

<!--FILTER BY TYPE!-->

<div>
    <form method="post" action="filterType.php">
        <fieldset>
            <legend>Filter By Type</legend>
                <select name="Type">
                    <?php
                    if(!($stmt = $mysqli->prepare("SELECT type_id, type_name FROM Type"))){
                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }

                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    if(!$stmt->bind_result($type_id, $type_name)){
                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    while($stmt->fetch()){
                     echo '<option value=" '. $type_id . ' "> ' . $type_name . '</option>\n';
                    }
                    $stmt->close();
                    ?>
                </select>
        </fieldset>
        <input type="submit" value="Run Filter" />
    </form>
</div>

<!--FILTER BY BASE HP!-->

<div>
    <form method="post" action="filterBaseHP.php">
        <fieldset>
            <legend>Filter By Base HP</legend>
                <select name="BaseHP">
                    <?php
                    if(!($stmt = $mysqli->prepare("SELECT basehp_id, hp FROM Base_hp"))){
                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }

                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    if(!$stmt->bind_result($basehp_id, $hp)){
                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    while($stmt->fetch()){
                     echo '<option value=" '. $basehp_id . ' "> ' . $hp . '</option>\n';
                    }
                    $stmt->close();
                    ?>
                </select>
        </fieldset>
        <input type="submit" value="Run Filter" />
    </form>
</div>

<!--FILTER BY MOVE!-->

<div>
    <form method="post" action="filterMove.php">
        <fieldset>
            <legend>Filter By Move</legend>
                <select name="Move">
                    <?php
                    if(!($stmt = $mysqli->prepare("SELECT move_id, move_name FROM Move"))){
                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }

                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    if(!$stmt->bind_result($move_id, $move_name)){
                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    while($stmt->fetch()){
                     echo '<option value=" '. $move_id . ' "> ' . $move_name . '</option>\n';
                    }
                    $stmt->close();
                    ?>
                </select>
        </fieldset>
        <input type="submit" value="Run Filter" />
    </form>
</div>

<!--FILTER BY EVOLUTIONS!-->

<div>
    <form method="post" action="filterEvolutions.php">
        <fieldset>
            <legend>Filter By Evolutions</legend>
                <select name="Evolutions">
                    <?php
                    if(!($stmt = $mysqli->prepare("SELECT evolution_id, evolution_number FROM Evolutions"))){
                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }

                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    if(!$stmt->bind_result($evolution_id, $evolution_number)){
                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    while($stmt->fetch()){
                     echo '<option value=" '. $evolution_id . ' "> ' . $evolution_number . '</option>\n';
                    }
                    $stmt->close();
                    ?>
                </select>
        </fieldset>
        <input type="submit" value="Run Filter" />
    </form>
</div>

<!--FILTER BY TYPE AGGREGATE SUM!-->

<div>
    <form method="post" action="filterTypeSum.php">
        <fieldset>
            <legend>Filter By Type WITH Count PER Type</legend>
                <select name="Type">
                    <?php
                    if(!($stmt = $mysqli->prepare("SELECT type_id, type_name FROM Type"))){
                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }

                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    if(!$stmt->bind_result($type_id, $type_name)){
                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
                    while($stmt->fetch()){
                     echo '<option value=" '. $type_id . ' "> ' . $type_name . '</option>\n';
                    }
                    $stmt->close();
                    ?>
                </select>
        </fieldset>
        <input type="submit" value="Run Filter" />
    </form>
</div>


</body>
</html>