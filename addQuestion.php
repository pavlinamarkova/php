<!DOCTYPE html>
<html>
<head>
    <title>Add and Display Questions</title>
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

if (isset($_POST['submit'])) {

    $question = addslashes($_POST['question']);
    $query = "INSERT INTO questions (question) VALUES ('$question')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Question added successfully";
    } else {
        echo "Error adding question: " . mysqli_error($conn);
    }
}

$query = "SELECT * FROM questions";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h1 class='text-center'>Questions</h1>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p class='text-center'>" . $row["question"] . " <a href='detailOfQuestion.php?id_question=" . $row["id_question"] . "'>Details</a></p>";

    }
}

mysqli_free_result($result);
mysqli_close($conn);
?>
    <div class="container p-5 text-center" >
<h2 class="text-center">Add Question</h2>
<form action="addQuestionForm.php" method="post">
    <textarea name="question"></textarea><br>
    <input type="submit" name="submit" value="Add Question"class="text-center">
 
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
