<!DOCTYPE html>
<html>
<head>
<?php
$db = new SQLite3('doctordb.sqlite');
?>
  <style>
    table, th, td {
      border: 1px solid black;
      }
  </style>
  <title>
    ID3 algorithm
  </title>
</head>
<body>
  <h2>Here is the result of ID3 algorithm: </h2>

  <p>
  <?php
    $command = escapeshellcmd('python3 test.py');
    $output = shell_exec($command);
    echo $output;
  ?>
  </p>

  <form action="Task.php">
    <input type="submit" value="Complete another survey" />
  </form>
  <form action="afterform.php">
    <input type="submit" value="See the results of the survey" />
  </form>
  </body>
</html>
