<!DOCTYPE html>
<html>
<head>
    <title>Question Details</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

$conn = mysqli_connect("host","user","password","db-name");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$id_question = addslashes($_GET["id_question"]);

if (isset($_POST['submit'])) {
    $answer = addslashes($_POST["answer"]);
    $id_question = $_POST["id_question"];

    $sql = "INSERT INTO answers (id_q, answer) VALUES ('$id_question', '$answer')";
    if (mysqli_query($conn, $sql)) {
        echo "Answer added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


$sql = "SELECT * FROM questions WHERE id_question = '$id_question'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h2 class='text-center'>Question:</h2>";
        echo "<p class='text-center'>" . $row["question"] . "</p>";
    }
} else {
    echo "No question found.";
}


$sql = "SELECT * FROM answers WHERE id_q = '$id_question'";
$result = mysqli_query($conn, $sql);


echo "<h2 class='text-center'>Answers:</h2>";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p class='text-center'>" . $row["answer"] . "</p>";
    }
} else {
    echo "No answers found.";
}

mysqli_free_result($result);
mysqli_close($conn);
?>
<div class="container p-5" >
<h2 class='text-center' >Add Answer:</h2>
<form class='text-center' action="detailOfQuestion.php" method="post">
    <label for="answer">Answer:</label>
    <input type="hidden" name="id_question" value="<?php echo $id_question; ?>">
    <input type="text" id="answer" name="answer">
    <input type="submit" value="Submit" name="submit">
</form>
  </div>
  
      <div class="container p-5" >

        <ul class="list-group">
            <a href="home.php" class="list-group-item list-group-item-action list-group-item-light">Main Page
            </a>
                      <a href="QuestionAndAnswers.php" class="list-group-item list-group-item-action list-group-item-light">See all the questions and answers
            </a>
        </ul>
        <p class="mt-5 mb-3">&copy;pavlina.markova.developer@gmail.com 2023</p>

    </div>

</body>
</html>
