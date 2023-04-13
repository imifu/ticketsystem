<!DOCTYPE html>

<html lang="jp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <h1>こんにちは久保</h1>
  
    <?php

    $link = mysqli_connect("laravel_db", "root", "root", "ticket");

    $query = "SELECT * FROM news;";
    $result = mysqli_query($link, $query);

    // 返ってきた結果を存在するだけ回す
    while ($row = $result->fetch_assoc()) {

      echo "<table>";
      echo $row["header_text"];
      echo "<hr />";

    }

    ?>

    <table border="1">
      <tr>
        <td>Cell 1</td>
        <td>Cell 2</td>
        <td>Cell 3</td>
      </tr>
      <tr>
        <td>Cell 4</td>
        <td>Cell 5</td>
        <td>Cell 6</td>
      </tr>
    </table>

    <hr />

    <a href="./confirm.php">確認ページへ</a>

    <form action="./confirm.php" method="POST" style="border:1px solid #000">

      <p>お名前</p>
      <input type="text" name="name" value="" />

      <p>メールアドレス</p>
      <input type="text" name="email" value="" />

      <p>お問い合わせ内容</p>
      <textarea name="content" rows="8" cols="80"></textarea>

      <input type="color" name="" value="" />

      <input type="radio">男性
      <input type="radio">女性

      <select name="kyouka" id="">
        <option value="国語">国語</option>
        <option value="数学">数学</option>
      </select>


      
      <input type="submit" value="送信" />



    </form>

  </body>
</html>
