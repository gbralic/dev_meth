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
    Results if the survey
  </title>
</head>
<body>
  <h2>Thank you for completing the survey !</h2>
  <p> Here are the answers to the survey : </p>
  <table style="width:100%">
    <tr>
      <?php
      $test = $db->query('SELECT * FROM questions');
      while ($row = $test->fetchArray()) {
        echo "<th>$row[1]</th>";
      }
      ?>
    </tr>
    <?php
    $test = $db->query('SELECT * FROM answers');
    while ($row = $test->fetchArray()) {
      echo "<tr>";
        echo "<th>$row[1]</th>";
        echo "<th>$row[2]</th>";
        echo "<th>$row[3]</th>";
        echo "<th>$row[4]</th>";
        echo "<th>$row[5]</th>";
        echo "<th>$row[6]</th>";
        echo "<th>$row[7]</th>";
        echo "<th>$row[8]</th>";
        echo "<th>$row[9]</th>";
        echo "<th>$row[10]</th>";
        echo "<th>$row[11]</th>";
      echo "</tr>";
    }
     ?>
  </table>


  <form action="index.php">
    <input type="submit" value="Complete another survey" />
  </form>
  <form action="id3alg.php">
    <input type="submit" value="See the ID3 algorithm" />
  </form>
  </body>
</html>
