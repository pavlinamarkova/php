<!DOCTYPE html>
<html>
<head>
    <title>All Questions and Answers</title>
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


 $sql = "SELECT q.id_question, q.question, a.id_answer, a.answer, a.votes
        FROM questions q
        LEFT JOIN answers a
        ON q.id_question = a.id_q
        ORDER BY q.id_question, a.votes DESC";
  

if (isset($_GET['id_answer'])) {
    $id_answer = addslashes($_GET['id_answer']);
    $query = "UPDATE answers SET votes = votes + 1 WHERE id_answer = $id_answer";
	$result = mysqli_query($conn, $query);
    if (($result) === TRUE) {
        header("Location: QuestionsAndAnswers.php");     
    } else {
        echo "Error updating record: " . $conn->error;
    }

}

  
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    
    $currentQuestion = null;
    while($row = $result->fetch_assoc()) {
        if ($currentQuestion != $row["question"]) {
            echo "<h2 class='text-center'>" . $row["question"] . "</h2>";
            $currentQuestion = $row["question"];
        }
       echo "<p class='text-center'>"  .$row["answer"] . " <a class='text-center' href='QuestionsAndAnswers.php?id_answer=" . $row["id_answer"] . "'>" . $row["votes"] . "</a> votes</p><br>";
    }
} else {
    echo "0 results";
}
mysqli_free_result($result);
$conn->close();

?>
      <div class="container p-5">

        <ul class="list-group">
                      <a href="home.php" class="list-group-item list-group-item-action list-group-item-light">Main Page
            </a>
            <a href="addQuestionForm.php" class="list-group-item list-group-item-action list-group-item-light">Add new question</a>
        </ul>
        <p class="mt-5 mb-3">&copy;pavlina.markova.developer@gmail.com 2023</p>

    </div>
  
</body>
</html>
