<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dir = $_POST["dir"];
    if (!empty($dir)) {
        echo "<pre>";
        echo shell_exec("ls $dir");
        echo "</pre>";
    } else {
        echo "Please provide a directory to list.";
    }
}
?>
<html>
<head><title>List directory</title></head>
<body>
<h1>You can list our directiories in Linux!</h1>
<h2>Executed command: ls <directory></h2>
<form method="post" action="">
    <label for="dir">Enter directory to list:</label><br>
    <input type="text" id="dir" name="dir"><br><br>
    <input type="submit" value="directory">
</form>
</body>
</html>
