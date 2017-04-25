<html>
    <head>

    </head>
    <body>

    <?php
    session_start();

//    Partie 3: colocar a variavel world dentro da seção (jeito mais sujo e mais facil). Tomar cuidado para não usar variaveis intermediarias (como $room = $_SESSION["world"][$room_number]) porque assim ao modificar $room a variavel original na seção não será modificada


    $objects = array(
            array("name" => "Sword",
                "condition" => array(0, 0, 0)),
            array("name" => "Gloves",
                "condition" => array(1, 0, 0)),
            array("name" => "Super hot key",
                "condition" => array(0, 2, 0)),
    );



    if (isset($_SESSION["username"])) {
        switch ($_GET["command"]) {
            case "login":
                default_logged_command();
                break;
            case "logout":
                logout_command();
                break;
            case "go":
                go_command();
                break;
            case "take":
                take_command();
                break;
            case "put":
                break;
            default:
                if (isset($_GET["command"])) {
                    unknown_command();
                } else {
                    default_logged_command();
                }
        }

    } else {
        if ($_GET["command"] == "login") {
            login_command();
        } else {
            echo "<h3>Hi there! You must login first!</h3>";
            default_unlogged_command();
        }
    }


    function logout_command() {
        session_destroy();
        echo "<h2>Goodbye!</h2>";
        default_unlogged_command();
    }

    function login_command() {
        $_SESSION["username"] = $_GET["username"];
        $_SESSION["room"] = 0;
        $_SESSION["inventory"] = array();

        global $objects;
        foreach ($objects as $index => $name) {
            $_SESSION["inventory"][$index] = 0;
        }

        $_SESSION["world"] =  array(
            array("name" => "Chambre Jaune",
                "outs" => array (
                    "porte" => 1,
                    "fenêtre" => 2),
                "stuff" => array(1, 2, 3),
                "condition" => array(0, 0, 0)

            ), array("name" => "Chambre Verte",
                "outs" => array (
                    "porte" => 0,
                    "fenêtre" => 2),
                "stuff" => array(4, 2, 0),
                "condition" => array(1, 0, 0)

            ), array("name" => "Jardin",
                "outs" => array (
                    "fenêtre Jaune" => 0,
                    "fenêtre verte" => 1),
                "stuff" => array(0, 5, 0),
                "condition" => array(0, 0, 1)
            ),
        );

        default_logged_command();
    }

    /**
     *
     */
    function default_logged_command() {
        global $objects;

        $username = $_SESSION["username"];

        echo "<h3>Hello $username</h3>";

        $room_number = $_SESSION["room"];
        $room_name = $_SESSION["world"][$room_number]["name"];

        echo "<h4>You are in the room \"$room_name\" ($room_number)</h4>";

        echo "This room contains:<ul>";
        foreach($_SESSION["world"][$room_number]["stuff"] as $index => $quantity) {
            $object = $objects[$index]["name"];
            $quantity = $_SESSION["world"][$room_number]['stuff'][$index];

            echo "<li>$object: $quantity";

            if($quantity > 0) {
                echo " - <a href=\"game.php?command=take&objectIndex=$index\">take</a>";
            }

            echo "</li>";
        }
        echo "</ul>";

        foreach ($_SESSION["world"][$room_number]["outs"] as $passage => $destinationIndex) {
            $destination = $_SESSION["world"][$destinationIndex]["name"];
            echo "Go to $destination ($destinationIndex) through $passage<br>";
        }

        echo "<form action='game.php' method='get'>
                Choose your destination (number): <input type='text' name='destination'>
                <input hidden name='command' value='go'>
                <input type='submit'>
              </form>";

//        echo "<h3>";
//        echo $_SESSION["world"][$room_number]["win"];
//        echo "</h3>";
//        echo "<h3>";
//        echo $_SESSION["world"][$room_number]["lose"];
//        echo "</h3>";

        echo "<h4>You have:</h4><ul>";
        foreach($_SESSION["inventory"] as $index => $quantity) {
            $object = $objects[$index]["name"];
            $quantity = $_SESSION["inventory"][$index];
            echo "<li>$object: $quantity</li>";
        }
        echo "</ul>";

        echo "<br><a href=\"game.php?command=logout\">Logout</a>";
    }

    function default_unlogged_command() {
        echo "<form action='game.php' method='get'>
                Username: <input type=\"text\" name=\"username\">
                <input hidden name='command' value='login'>
                <input type=\"submit\">
            </form>";
    }

    function unknown_command() {
        ?>
            <h2>Error!</h2><h3>Unknown command</h3>
        <?php
    }

    function go_command() {
        global $objects;

        $destinationIndex = $_GET["destination"];
        $hasRequirements = true;
//        echo("-----");
//        echo($_SESSION["world"][$destinationIndex]["condition"]);
//        echo("-----");
//        echo($_SESSION["world"][$destinationIndex]["condition"][0]);

        foreach ($_SESSION["world"][$destinationIndex]["condition"] as $objectIndex => $requiredValue) {
            if ($_SESSION["inventory"][$objectIndex] < $requiredValue) {
                $objectName = $objects[$objectIndex]["name"];
                echo "You need $requiredValue {$objectName}" . ($requiredValue>1?"s":"") . " to enter this room";
                $hasRequirements = false;
            }
        }

        if ($hasRequirements) {
            $_SESSION["room"] = $_GET["destination"];
        }

        default_logged_command();
    }

    function take_command() {
        global $objects;
        $objectTakeIndex = $_GET["objectIndex"];
        $objectTakeName = $objects[$objectTakeIndex]["name"];
        $hasRequirements = true;

        if ($_SESSION["world"][$_SESSION["room"]]["stuff"][$objectTakeIndex] > 0) {


            foreach ($objects[$objectTakeIndex]["condition"] as $objectRequirementIndex => $requiredValue) {
                if ($_SESSION["inventory"][$objectRequirementIndex] < $requiredValue) {
                    $objectRequiredName = $objects[$objectRequirementIndex]["name"];
                    echo "You need $requiredValue {$objectRequiredName}" . ($requiredValue>1?"s":"") . " to take the $objectTakeName";
                    $hasRequirements = false;
                }
            }


            if ($hasRequirements) {
                $_SESSION["world"][$_SESSION["room"]]["stuff"][$objectTakeIndex] -= 1;
                $_SESSION["inventory"][$objectTakeIndex] += 1;
            }
        }

        default_logged_command();
    }

    ?>

    </body>
</html>




