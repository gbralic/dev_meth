<!DOCTYPE html>
<html>
<head>
  <title>
    Questions for ID3 algorithm
  </title>
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<?php
// define error variables and set to empty values
$repErr = $rep1Err = $rep2Err = $rep3Err = $rep4Err = $rep5Err = $rep6Err = $rep7Err = $rep8Err  = $rep9Err = $rep10Err = "";
// define variables and set to empty values
$rep = $rep1 = $rep2 = $rep3 = $rep4 = $rep5 = $rep6 = $rep7 = $rep8  = $rep9 = $rep10 = "";

// definition of Questions
// main question
define("quest","Will you go to the doctor ?");

// other questions
define("quest1","Are you in pain ?");
define("quest2","Do you have an appointment ?");
define("quest3","When was your last visit ? (in weeks)");
define("quest4","How old are you ?");
define("quest5","Are you pregnant ?");
define("quest6","Do you have a chronical disease ?");
define("quest7","Do you smoke ?");
define("quest8","How often do you do sports ?");
define("quest9","How far is the doctor office ? (in km)");
define("quest10","Do you like your doctor ?");

define("ErrorMsg","You need to choose an answer for this question ! ");
define("ErrorInt","It needs to be an number");

// creation of the database

$db = new SQLite3('doctordb.sqlite');
$db->exec("CREATE TABLE questions(q_id INTEGER PRIMARY KEY, q_name TEXT NOT NULL UNIQUE)");
$db->exec("CREATE TABLE answers(a_id INTEGER PRIMARY KEY, main_ans TEXT, ans1 TEXT, ans2 TEXT, ans3 INTEGER, ans4 INTEGER, ans5 TEXT, ans6 TEXT, ans7 TEXT, ans8 TEXT, ans9 INTEGER, ans10 TEXT)");

$stmt = $db->prepare('INSERT INTO questions(q_name) VALUES (:quest),(:quest1),(:quest2),(:quest3),(:quest4),(:quest5),(:quest6),(:quest7),(:quest8),(:quest9),(:quest10)');
$stmt->bindValue(':quest', quest);
$stmt->bindValue(':quest1', quest1);
$stmt->bindValue(':quest2', quest2);
$stmt->bindValue(':quest3', quest3);
$stmt->bindValue(':quest4', quest4);
$stmt->bindValue(':quest5', quest5);
$stmt->bindValue(':quest6', quest6);
$stmt->bindValue(':quest7', quest7);
$stmt->bindValue(':quest8', quest8);
$stmt->bindValue(':quest9', quest9);
$stmt->bindValue(':quest10', quest10);
$result = $stmt->execute();

// Conditions to save the data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["rep"])) {
    $repErr = ErrorMsg;
  } else {
    $rep = test_input($_POST["rep"]);
  }
  if (empty($_POST["rep1"])) {
    $rep1Err = ErrorMsg;
  } else {
    $rep1 = test_input($_POST["rep1"]);
  }
  if (empty($_POST["rep2"])) {
    $rep2Err = ErrorMsg;
  } else {
    $rep2 = test_input($_POST["rep2"]);
  }
  if (empty($_POST["rep3"])) {
    $rep3Err = ErrorMsg;
  } else {
    $rep3 = test_input($_POST["rep3"]);
    if (!is_numeric($rep3 )) {
      $rep3Err = ErrorInt;
    }
  }
  if (empty($_POST["rep4"])) {
    $rep4Err = ErrorMsg;
  } else {
    $rep4 = test_input($_POST["rep4"]);
    if (!is_numeric($rep4 )) {
      $rep4Err = ErrorInt;
    }
  }
  if (empty($_POST["rep5"])) {
    $rep5Err = ErrorMsg;
  } else {
    $rep5 = test_input($_POST["rep5"]);
  }
  if (empty($_POST["rep6"])) {
    $rep6Err = ErrorMsg;
  } else {
    $rep6 = test_input($_POST["rep6"]);
  }
  if (empty($_POST["rep7"])) {
    $rep7Err = ErrorMsg;
  } else {
    $rep7 = test_input($_POST["rep7"]);
  }
  if (empty($_POST["rep8"])) {
    $rep8Err = ErrorMsg;
  } else {
    $rep8 = test_input($_POST["rep8"]);
  }
  if (empty($_POST["rep9"])) {
    $rep9Err = ErrorMsg;
  } else {
    $rep9 = test_input($_POST["rep9"]);
    if (!is_numeric($rep9 )) {
      $rep9Err = ErrorInt;
    }
  }
  if (empty($_POST["rep10"])) {
    $rep10Err = ErrorMsg;
  } else {
    $rep10 = test_input($_POST["rep10"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<body>

  <h2>Doctor Visit Questionary</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Main Question  : <?php echo quest?>
          <input type="radio" name="rep" <?php if (isset($rep) && $rep=="Yes") echo "checked";?> value="Yes"> Yes
          <input type="radio" name="rep" <?php if (isset($rep) && $rep=="No") echo "checked";?> value="No"> No
          <span class="error"> <?php echo $repErr;?></span>
        <br><br>
        Question 1 : <?php echo quest1?>
          <input type="radio" name="rep1" <?php if (isset($rep1) && $rep1=="a_lot") echo "checked";?> value="a_lot"> A lot
          <input type="radio" name="rep1" <?php if (isset($rep1) && $rep1=="a_little_bit") echo "checked";?> value="a_little_bit"> A little bit
          <input type="radio" name="rep1" <?php if (isset($rep1) && $rep1=="not_at_all") echo "checked";?> value="not_at_all"> Not at all
          <span class="error"> <?php echo $rep1Err;?></span>
        <br><br>
        Question 2 : <?php echo quest2?>
          <input type="radio" name="rep2" <?php if (isset($rep2) && $rep2=="Yes") echo "checked";?> value="Yes"> Yes
          <input type="radio" name="rep2" <?php if (isset($rep2) && $rep2=="No") echo "checked";?> value="No"> No
          <span class="error"> <?php echo $rep2Err;?></span>
        <br><br>
        Question 3 : <?php echo quest3?>
          <input type="text" name="rep3" value="<?php echo $rep3;?>">
          <span class="error"> <?php echo $rep3Err;?></span>
        <br><br>
        Question 4 : <?php echo quest4?>
          <input type="text" name="rep4" value="<?php echo $rep4;?>">
          <span class="error"> <?php echo $rep4Err;?></span>
        <br><br>
        Question 5 : <?php echo quest5?>
          <input type="radio" name="rep5" <?php if (isset($rep5) && $rep5=="Yes") echo "checked";?> value="Yes"> Yes
          <input type="radio" name="rep5" <?php if (isset($rep5) && $rep5=="No") echo "checked";?> value="No"> No
          <span class="error"> <?php echo $rep5Err;?></span>
        <br><br>
        Question 6 : <?php echo quest6?>
          <input type="radio" name="rep6" <?php if (isset($rep6) && $rep6=="Yes") echo "checked";?> value="Yes"> Yes
          <input type="radio" name="rep6" <?php if (isset($rep6) && $rep6=="No") echo "checked";?> value="No"> No
          <span class="error"> <?php echo $rep6Err;?></span>
        <br><br>
        Question 7 : <?php echo quest7?>
          <input type="radio" name="rep7" <?php if (isset($rep7) && $rep7=="Yes") echo "checked";?> value="Yes"> Yes
          <input type="radio" name="rep7" <?php if (isset($rep7) && $rep7=="No") echo "checked";?> value="No"> No
          <span class="error"> <?php echo $rep7Err;?></span>
        <br><br>
        Question 8 : <?php echo quest8?>
          <input type="radio" name="rep8" <?php if (isset($rep8) && $rep8=="more3") echo "checked";?> value="more3"> More than 3 times a week
          <input type="radio" name="rep8" <?php if (isset($rep8) && $rep8=="more1") echo "checked";?> value="more1"> Between 1 and 3 times a week
          <input type="radio" name="rep8" <?php if (isset($rep8) && $rep8=="never") echo "checked";?> value="never"> Never
          <span class="error"> <?php echo $rep8Err;?></span>
        <br><br>
        Question 9 : <?php echo quest9?>
          <input type="text" name="rep9" value="<?php echo $rep9;?>">
          <span class="error"> <?php echo $rep9Err;?></span>
        <br><br>
        Question 10 : <?php echo quest10?>
          <input type="radio" name="rep10" <?php if (isset($rep10) && $rep10=="Yes") echo "checked";?> value="Yes"> Yes
          <input type="radio" name="rep10" <?php if (isset($rep10) && $rep10=="No") echo "checked";?> value="No"> No
          <span class="error"> <?php echo $rep10Err;?></span>
        <br><br>
      <input type="submit" name="submit" value="Submit">
    </form>

<?php

if ($rep=="" or $rep1=="" or $rep2=="" or $rep3=="" or $rep4=="" or $rep5=="" or $rep6=="" or $rep7=="" or $rep8=="" or $rep9=="" or $rep10==""){
  echo "<p><span class='error'> You must complete all fields ! </span></p>";
}else{
  if ($repErr=="" and $rep1Err=="" and $rep2Err=="" and $rep3Err=="" and $rep4Err=="" and $rep5Err=="" and $rep6Err=="" and $rep7Err=="" and $rep8Err=="" and $rep9Err=="" and $rep10Err==""){
    $stmt = $db->prepare('INSERT INTO answers(main_ans,ans1,ans2,ans3,ans4,ans5,ans6,ans7,ans8,ans9,ans10) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->bindValue(1, $rep);
    $stmt->bindValue(2, $rep1);
    $stmt->bindValue(3, $rep2);
    $stmt->bindValue(4, $rep3);
    $stmt->bindValue(5, $rep4);
    $stmt->bindValue(6, $rep5);
    $stmt->bindValue(7, $rep6);
    $stmt->bindValue(8, $rep7);
    $stmt->bindValue(9, $rep8);
    $stmt->bindValue(10, $rep9);
    $stmt->bindValue(11, $rep10);
    $result = $stmt->execute();
    header("Location: http://localhost:8000/afterform.php");

  }else{
    echo "<p><span class='error'> Some informations are incorrect ! </span></p>";
  }
}
?>
