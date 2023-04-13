
<h1>確認画面</h1>
<?php

echo "あなたのメールアドレスは".$_POST["email"]."なんですね？";
echo "<br />";
echo "あなたの名前は".$_POST["name"]."なんですね？";
?>


  
<br /><br />
<a href="./thanks.php">OK</a>

<form action="./thanks.php" method="POST">

    <input type="hidden" name="name" value="<?php echo $_POST["name"]; ?>">
    <input type="hidden" name="email" value="<?php echo $_POST["email"]; ?>">

    <input type="submit" value="OK">

</form>



<br />
<button type="button" onclick="history.back()">戻る</button>