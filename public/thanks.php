<?php echo $_POST["name"]; ?> thanks!


<?php

$link = mysqli_connect("laravel_db", "root", "root", "ticket");

$query = "INSERT INTO news VALUES(null, '{ $_POST["name"] }');";
$result = mysqli_query($link, $query);

// 返ってきた結果を存在するだけ回す
while ($row = $result->fetch_assoc()) {

  echo $row["header_text"];
  echo "<hr />";

}




?>