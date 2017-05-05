<html>
    <head>
        <style>
            html * {
                font-family: Courier New;
                background-color: black;
                color: white;
            }


            #content {
                width:1000px;
                margin:0 auto;
            }

            #nav{
                float:left;
                margin-right: 30px;
                width:600px;
            }

            #body{
                float:right:
                margin-left:30px;
            }

            .warning{
                color: #f85d0a;
                font-size: 20px;
                text-align: center;
            }

            .room-text{
                /*color: #8de1f8;*/
                /*font-size: x-large;*/
                font-style: italic;
                text-align: left;
                margin-top: 40px;
                margin-bottom: 40px;
                font-weight: bold;
            }

            .room-win{
                color: #32f80d;
                font-size: xx-large;
                text-align: center  ;
                margin-top: 40px;
                margin-bottom: 40px;
            }

            .room-lose{
                color: #ff0000;
                font-size: xx-large;
                text-align: center;
                margin-top: 40px;
                margin-bottom: 40px;
            }

            .item{
                text-align: left;
            }

        </style>
    </head>
    <body>
        <div id="content-wrapper">
            <div id="content">
                <div id="nav">
                </div>
                <div id="body">
                    <?php
                    session_start();
                    session_start();

                    $objects = array(
                        array("name" => "Small key",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Invitation letter",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Candle",
                            "condition" => array(0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Glove",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Match stick",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Knife",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Screw driver",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Mobile phone",
                            "condition" => array(0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Sword",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Axe",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Spoon",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Pistol",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Shield",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "NFC Badge",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Blue pill",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Red pill",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
                        array("name" => "Heavy key",
                            "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)),
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
                            case "drop":
                                drop_command();
                                break;
                            case "map";
                                map_command();
                                return;
                            case "where":
                                where_command();
                                return;
                            case "outs":
                                outs_command();
                                return;
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
                            array("name" => "Main Entrance", // room 0
                                "outs" => array (
                                    "door" => 1,
                                    "window" => 2),
                                "stuff" => array(1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 0, "y" => 0, "width" => 50, "height" => 20), // x, y, width, height
                                "color" => "#050000",
                                "text" => "You have just arrived, and your coat is soaking wet.",
                                "win" => false,
                                "lose" => false,

                                ), array("name" => "Coat Room", // room 1
                                "outs" => array (
                                    "autre porte" => 0),
                                "stuff" => array(0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 20, "y" => 20, "width" => 30, "height" => 20),
                                "color" => "#170000",
                                "text" => "There a small paper in the floor, it invites you to the Great Ball.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Grand Hall",  // room 2
                                "outs" => array (
                                    "fenêtre Jaune" => 0,
                                    "fenêtre Verte" => 3,
                                    "fenêtre Rouge" => 15),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 0, "y" => 20, "width" => 20, "height" => 30),
                                "color" => "#290000",
                                "text" => "You enter the Grand Hall, but it's empty, strange...",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Main Corridor",  // room 3
                                "outs" => array (
                                    "fenêtre Jaune" => 4,
                                    "fenêtre Rouge" => 2,
                                    "fenêtre verte" => 16),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 20, "y" => 40, "width" => 50, "height" => 20),
                                "color" => "#3B0000",
                                "text" => "You see a shadow mooving! It's gone now, but it left you a gift. Should you take it?",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Dining Room",  // room 4
                                "outs" => array (
                                    "Porte 1" => 6,
                                    "Porte 2" => 5,
                                    "Porte 3" => 3,
                                ),
                                "stuff" => array(0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 60, "y" => 10, "width" => 30, "height" => 30),
                                "color" => "#4D0000",
                                "text" => "The smell if very strange, seems like the food is here for a loooong time.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Terrace",  // room 5
                                "outs" => array (
                                    "Porte 1" => 6,
                                    "Porte 2" => 4,
                                ),
                                "stuff" => array(0, 0, 0, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 50, "y" => 0, "width" => 10, "height" => 40),
                                "color" => "#5F0000",
                                "text" => "Some fresh air at least! The stars are beautiful tonight.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Buffet Room",  // room 6
                                "outs" => array (
                                    "Porte 1" => 5,
                                    "Porte 2" => 7,
                                    "Porte 3" => 4,
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 60, "y" => 0, "width" => 30, "height" => 10),
                                "color" => "#710000",
                                "text" => "There is a pile of plates here, but they haven't been used for a while.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Kitchen Corridor",  // room 7
                                "outs" => array (
                                    "Porte 1" => 6,
                                    "Porte 2" => 8,
                                    "Porte 3" => 17,
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 90, "y" => 0, "width" => 10, "height" => 70),
                                "color" => "#830000",
                                "text" => "It's pitch dark in here. Fortunately you have something to light you your path.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Kitchen",  // room 8
                                "outs" => array (
                                    "Porte 1" => 9,
                                    "Porte 2" => 11,
                                    "Porte 3" => 7,
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 70, "y" => 60, "width" => 20, "height" => 40),
                                "color" => "#940000",
                                "text" => "Finally, some food! But it's make of plastic. You are starving.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Survailance Room",  // room 9
                                "outs" => array (
                                    "Porte 1" => 10,
                                    "Porte 2" => 8,
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 30, "y" => 60, "width" => 40, "height" => 10),
                                "color" => "#A60000",
                                "text" => "There is something beeping in here. You touch a button and a screen lights up. There are lots of green letters and numbers running in the screen.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Armory",  // room 10
                                "outs" => array (
                                    "Porte 1" => 18,
                                    "Porte 2" => 9,
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 0, "y" => 60, "width" => 30, "height" => 20),
                                "color" => "#B80000",
                                "text" => "This room is huge! Much bigger than it seems and there are so many different weapons you don't know which one to get.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Staff Corridor",  // room 11
                                "outs" => array (
                                    "Porte 1" => 12,
                                    "Porte 2" => 8,
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0),
                                "coordinates" => array("x" => 30, "y" => 90, "width" => 40, "height" => 10),
                                "color" => "#CA0000",
                                "text" => "There are some uniforms here... and some strange metal plugs and cables.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Staff Room",  // room 12
                                "outs" => array (
                                    "Porte 1" => 11,
                                    "Porte 2" => 13,
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 30, "y" => 70, "width" => 10, "height" => 20),
                                "color" => "#DC0000",
                                "text" => "There are some strange chairs with screens and cables here, but they seem comfortable.",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Anti-Room",  // room 13
                                "outs" => array (
                                    "Porte 1" => 12,
                                    "Porte 2" => 19,
                                    "Porte 3" => 14,
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 40, "y" => 70, "width" => 20, "height" => 10),
                                "color" => "#EE0000",
                                "text" => "A phone is ringing. You answer it. A strange voice starts talking and asks you: <i>\"You take the blue pill, the story ends. You wake up in your bed and believe whatever you want to believe. You take the red pill, you stay in Wonderland, and I show you how deep the rabbit hole goes\"</i>",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Red Room",  // room 14 - almost WIN
                                "outs" => array (
                                    "Porte" => 13,
                                    "Porte 2" => 20,
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
                                "coordinates" => array("x" => 60, "y" => 70, "width" => 10, "height" => 20),
                                "color" => "#FF0000",
                                "text" => "You start feeling weak, your vision starts to blur and a string light starts to shine all around you. You see a new passage opening...",
                                "win" => false,
                                "lose" => false,

                            ), array("name" => "Kennel",  // Lose 1 (15)
                                "outs" => array (
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 0, "y" => 50, "width" => 20, "height" => 10),
                                "color" => "#0000A1",
                                "text" => "There is a little puppy here! When you get near him he starts to bark and his mom appears",
                                "win" => false,
                                "lose" => "Too bad, she just ate you",

                            ), array("name" => "Garden",  // Lose 2 (16)
                                "outs" => array (
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 70, "y" => 40, "width" => 20, "height" => 20),
                                "color" => "#0000A1",
                                "text" => "The night is beautiful, but suddenly an enormous plant eats you",
                                "win" => false,
                                "lose" => "You were torn into pieces",

                            ), array("name" => "Garbage",  // Lose 3 (17)
                                "outs" => array (
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
                                "coordinates" => array("x" => 90, "y" => 70, "width" => 10, "height" => 30),
                                "color" => "#0000A1",
                                "text" => "When you step in the room the door locks and the floor opens",
                                "win" => false,
                                "lose" => "You fell 100 meters and died",

                            ), array("name" => "Combat Room",  // Lose 4 (18)
                                "outs" => array (
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 0, "y" => 80, "width" => 30, "height" => 20),
                                "color" => "#0000A1",
                                "text" => "A man appears from nowhere. You start fighting but nothing you do seems to hurt him",
                                "win" => false,
                                "lose" => "He beats you to death",

                            ), array("name" => "Blue Room",  // Lose 5 (19)
                                "outs" => array (
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0),
                                "coordinates" => array("x" => 40, "y" => 80, "width" => 20, "height" => 10),
                                "color" => "#0000A1",
                                "text" => "You wake up in your room, as if nothing happened but now you are locked, locked in a world rule by machines that only want to suck your energy",
                                "win" => false,
                                "lose" => "It will maybe be different in another lifetime",
                            ), array("name" => "Mega City",  // WIN
                                "outs" => array (
                                ),
                                "stuff" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "condition" => array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                                "coordinates" => array("x" => 10, "y" => 110, "width" => 80, "height" => 80),
                                "color" => "#0000A1",
                                "text" => "That's it! End of game, you won! You found the way out of the Matrix! But this was only your first victory...",
                                "win" => "... there is much more to fight for",
                                "lose" => false,
                            ),
                        );

                        init_world();

                        default_logged_command();
                    }


                    function default_logged_command() {
                        global $objects;

                        $username = $_SESSION["username"];

                        echo "<h3>Hello $username</h3>";

                        $room_number = $_SESSION["room"];
                        $room_name = $_SESSION["world"][$room_number]["name"];

                        echo "<h4 style='font-weight: normal'>You are in the room \"$room_name\"</h4>";

                        $room_text = $_SESSION["world"][$room_number]["text"];
                        if ($room_text) {
                            echo "<div class='room-text'>$room_text</div>";
                        }

                        $room_win = $_SESSION["world"][$room_number]["win"];
                        if ($room_win) {
                            echo "<div class='room-win'>$room_win</div>";
                        }

                        $room_lose = $_SESSION["world"][$room_number]["lose"];
                        if ($room_lose) {
                            echo "<div class='room-lose'>$room_lose</div>";
                        }

                        echo "This room contains:<table style='text-align:center'><theader><th></th><th>Room</th><th>Inventory</th></theader><tbody>";
                        foreach($_SESSION["world"][$room_number]["stuff"] as $index => $roomQuantity) {
                            $object = $objects[$index]["name"];
                            $playerQuantity = $_SESSION["inventory"][$index];

                            if($roomQuantity>0 || $playerQuantity>0) {
                                echo "<tr><th class='item'>$object: </th><td>$roomQuantity ";

                                if($roomQuantity > 0) {
                                    echo " <a href=\"game.php?command=take&objectIndex=$index\">take</a></td>";
                                }

                                echo "<td> $playerQuantity";
                                if($playerQuantity > 0) {
                                    echo " <a href=\"game.php?command=drop&objectIndex=$index\">drop</a></td>";
                                }
                                echo "</tr>";
                            }
                        }
                        echo "</tbody></table>";

                        echo "<script>document.getElementById(\"nav\").innerHTML = \"<canvas id='canvas'></canvas>\";</script>";
//
//                        foreach ($_SESSION["world"][$room_number]["outs"] as $passage => $destinationIndex) {
//                            $destination = $_SESSION["world"][$destinationIndex]["name"];
//                            echo "Go to $destination ($destinationIndex) through $passage<br>";
//                        }

//                        echo "<form action='game.php' method='get'>
//                                Choose your destination (number): <input type='text' name='destination'>
//                                <input hidden name='command' value='go'>
//                                <input type='submit'>
//                              </form>";
//
////        echo "<h3>";
////        echo $_SESSION["world"][$room_number]["win"];
////        echo "</h3>";
////        echo "<h3>";
////        echo $_SESSION["world"][$room_number]["lose"];
////        echo "</h3>";
//
//                        echo "<h4>You have:</h4><ul>";
//                        foreach($_SESSION["inventory"] as $index => $roomQuantity) {
//                            $object = $objects[$index]["name"];
//                            $roomQuantity = $_SESSION["inventory"][$index];
//                            echo "<li>$object: $roomQuantity</li>";
//                        }
//                        echo "</ul>";

                        echo "<br><br><br><a style='text-align: end; float:right' href=\"game.php?command=logout\">Logout</a>";
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
                        $isNeighbour = false;

                        // check if has requirements
                        foreach ($_SESSION["world"][$destinationIndex]["condition"] as $objectIndex => $requiredValue) {
                            if ($_SESSION["inventory"][$objectIndex] < $requiredValue) {
                                $objectName = $objects[$objectIndex]["name"];
                                echo "<div class='warning'>You need $requiredValue {$objectName}" . ($requiredValue>1?"s":"") . " to enter this room</div>";
                                $hasRequirements = false;
                            }
                        }

                        // check is player can go to that room
                        foreach ($_SESSION["world"][$_SESSION["room"]]["outs"] as $outIndex) {
                            if ($destinationIndex == $outIndex) {
                                $isNeighbour = true;
                            }
                        }

                        if ($hasRequirements && $isNeighbour) {
                            $_SESSION["room"] = $_GET["destination"];

                            // set new room to discovered
                            $_SESSION["world"][$_SESSION["room"]]["discovered"] = true;

                            // set neighbour rooms to visible
                            foreach ($_SESSION["world"][$_SESSION["room"]]["outs"] as $index => $room) {
                                $_SESSION["world"][$room]["visible"] = true;
                            }
                        }

                        if (!$isNeighbour && $destinationIndex != $_SESSION["room"]) {
                            echo "<div class='warning'>This room has no passage to the room you clicked</div>";
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
                                    echo "<div class='warning'>You need $requiredValue {$objectRequiredName}" . ($requiredValue>1?"s":"") . " to take the $objectTakeName</div>";
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

                    function drop_command() {
                        $objectTakeIndex = $_GET["objectIndex"];

                        if ($_SESSION["inventory"][$objectTakeIndex] > 0) {

                            $_SESSION["world"][$_SESSION["room"]]["stuff"][$objectTakeIndex] += 1;
                            $_SESSION["inventory"][$objectTakeIndex] -= 1;
                        }

                        default_logged_command();
                    }

                    function world_to_json() {
                        $world = $_SESSION["world"];
                        $jsonString = "[";

                        foreach ($world as $room) {
                            $color = $room["color"];
                            $jsonString .= "{ \"color\": \"$color\"";
                            $jsonString .= ", \"name\": \"".$room["name"]."\"";
                            $jsonString .= ", \"index\": ".$room["index"];
                            $jsonString .= ", \"discovered\": ".($room["discovered"]?"true":"false");
                            $jsonString .= ", \"visible\": ".($room["visible"]?"true":"false");
//            $jsonString .= ", \"coordinates\": [";

                            foreach ($room["coordinates"] as $key => $coordinate) {
                                $jsonString .= ", \"$key\": $coordinate";
                            }

//            $jsonString = substr($jsonString, 0, -1);
                            $jsonString .= "},";
                        }

                        $jsonString = substr($jsonString, 0, -1);
                        $jsonString .= "]";

                        return $jsonString;
                    }

                    function init_world() {
                        foreach ($_SESSION["world"] as $index => $room) {
                            $centerX = $room["coordinates"]["x"] + $room["coordinates"]["width"]/2;
                            $centerY = $room["coordinates"]["y"] + $room["coordinates"]["height"]/2;

                            // get center point
                            $_SESSION["world"][$index]["center"] = array("x" => $centerX, "y" => $centerY);

                            // set all room to undiscovered
                            $_SESSION["world"][$index]["discovered"] = false;

                            // set all rooms to hidden
                            $_SESSION["world"][$index]["visible"] = false;

                            // set room index
                            $_SESSION["world"][$index]["index"] = $index;
                        }

                        $_SESSION["world"][0]["discovered"] = true;
                        foreach ($_SESSION["world"][0]["outs"] as $index => $room) {
                            $_SESSION["world"][$room]["visible"] = true;
                        }

                    }

                    function map_command() {
                        ob_clean();
                        header('Content-Type: application/json');
                        echo world_to_json();
                    }

                    function where_command() {
                        ob_clean();
                        header('Content-Type: application/json');

                        $room = $_SESSION["world"][$_SESSION["room"]];
                        $x = $room["center"]["x"];
                        $y = $room["center"]["y"];
                        echo "{\"x\": $x, \"y\": $y}";
                    }

                    function outs_command() {
                        ob_clean();
                        header('Content-Type: application/json');

                        $json = "[ ";
                        foreach ($_SESSION["world"][$_SESSION["room"]]["outs"] as $outIndex) {
                            $json .= $outIndex . ",";
                        }
                        $json = substr($json, 0, -1);
                        $json .= "]";
                        echo $json;
                    }

                    ?>
                </div>
            </div>
        </div>

<!-- ----------------------------------------------------------------------------------------------------------- -->
    <script>
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        var size = 600;
        var rooms, outs, position;
        var lastRoomHover;
        var characterImage;


//        context.canvas.width = width = window.innerWidth;
//        context.canvas.height = width/2;
        context.canvas.width = size;
        context.canvas.height = size*2;
        context.fillStyle = "black";
        context.fillRect(0, 0, size, size);
        var scale = size/100;


        // listener for clicks
        canvas.addEventListener('click', function(event) {
            var room = collides(rooms, event.offsetX, event.offsetY);
            if (room) {
                window.location.replace("game.php?destination="+room.index+"&command=go");
            }
        }, false);

        // listener for hovers
        canvas.addEventListener('mousemove', function(event) {
            var roomHover = collides(rooms, event.offsetX, event.offsetY);

            if (roomHover.index !== lastRoomHover) {
                lastRoomHover = roomHover.index;

                rooms.forEach(function(room) {
                    drawRoom(room);
                });
                if (outs.includes(roomHover.index)) {
                    drawRoom(roomHover, true);
                }
            }
        }, false);


        getJson("game.php?command=map", function() {
            if (this.readyState === 4 && this.status === 200) {
                rooms = JSON.parse(this.responseText);


                // draw rooms' backgrounds
                rooms.forEach(function(room) {
                    room.x = room.x*scale;
                    room.y = room.y*scale;
                    room.width = room.width*scale;
                    room.height = room.height*scale;

                    drawRoom(room);
                });


//            } else {
//                console.log("Something went wrong");
//                console.log(this);
            }
        });


        getJson("game.php?command=where", function() {
            if (this.readyState === 4 && this.status === 200) {
                position = JSON.parse(this.responseText);
                position.x = position.x*scale;
                position.y = position.y*scale;
                drawCharacter(position.x, position.y);
//            } else {
//                console.log("Something went wrong");
//                console.log(this);
            }
        });


        getJson("game.php?command=outs", function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
                outs = JSON.parse(this.responseText);
//            } else {
//                console.log("Something went wrong");
//                console.log(this);
            }
        });


        function drawCharacter(x, y) {
            var size = 36;
            if (!characterImage) {
                characterImage = new Image();
                characterImage.src = "assets/knight_sprite_single.png";
                characterImage.onload = function() {
                    context.drawImage(characterImage, x-size/2, y-size/2, size, size);
                }
            } else {
                context.drawImage(characterImage, x-size/2, y-size/2, size, size);
            }
        }

        function drawRoom(room, hover) {
            if (room.visible) {
                context.fillStyle = "gray";
                context.fillRect(room.x, room.y, room.width, room.height);

                context.beginPath();
                context.lineWidth="2";
                context.strokeStyle = "darkgray";
                context.rect(room.x, room.y, room.width, room.height);
                context.stroke();

                if (position) {
                    drawCharacter(position.x, position.y);
                }
            }

            if (room.discovered) {
                context.fillStyle = room.color;
                context.fillRect(room.x, room.y, room.width, room.height);

                context.beginPath();
                context.lineWidth="2";
                context.strokeStyle = "darkgray";
                context.rect(room.x, room.y, room.width, room.height);
                context.stroke();
            }

            // write room's name
            if (room.discovered || room.visible) {
                context.font = "16px Arial";
                context.fillStyle = "white";
                context.fillText(room.name, room.x+10, room.y+20);
            }

            // draw white border if room is hovered and one of possible outs
            if (hover) {
                context.beginPath();
                context.lineWidth="2";
                context.strokeStyle = "red";
                context.rect(room.x, room.y, room.width, room.height);
                context.stroke();
            }
        }

        function getJson(url, callback) {
//            return new Promisse(resolve => {
                var request = new XMLHttpRequest();
                request.open("GET", url);
                request.onreadystatechange = callback;
                request.send();
//                resolve();
//            })
        }

        function collides(rooms, x, y) {
            var isCollision = false;
            rooms.forEach(function(room) {
                var left = room.x, right = room.x+room.width;
                var top = room.y, bottom = room.y+room.height;
                if (right >= x
                    && left <= x
                    && bottom >= y
                    && top <= y) {
                    isCollision = room;
                }
            });
            return isCollision;
        }

    </script>

    </body>
</html>