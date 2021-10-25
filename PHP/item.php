<?php
session_start();

//GETでidを取得
if(!isset($_GET["id"]) || $_GET["id"]==""){
  exit("ParamError!");
}else{
  $id = intval($_GET["id"]); //intval数値変換
}

//1.  DB接続します
try {
  // $pdo = new PDO('mysql:dbname=ellyhosaka_unit2;charset=utf8;host=mysql57.ellyhosaka.sakura.ne.jp','ellyhosaka','Eri-93149314');
  $pdo = new PDO('mysql:dbname=playcolor;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM ec_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  $row = $stmt->fetch(); //１レコードだけ取得：$row["フィールド名"]で取得可能
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/jquery.bxslider.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Hind&display=swap" rel="stylesheet">
<style>
body{
    font-family: 'Hind', sans-serif;
}

.item_content table{
	margin: 0 auto;
	font-size: 2rem;
}
.item_content td{
	padding-bottom: 20px;
}
.item_content h2{
	font-size: 2.5rem;
	padding-bottom: 20px;
  text-align:center;
  color:deeppink;
}
.item_content input{
	height: 3rem;
}
.item-label{
	justify-content: center;
	padding-top:10px;
}
.web_gl{
  margin-left:22.5rem;
}
.key{
  text-align:center;
  font-size:2rem;
}
</style>
<!-- unityのリンク -->
    <!-- <link rel="shortcut icon" href="TemplateData/favicon.ico">
    <link rel="stylesheet" href="TemplateData/style.css"> -->

</head>
<body>

<!-- unitywebGL -->
<?php 
if($id==3){
  echo '<div class="web_gl">';
  echo '<iframe class="color" width="970" height="650" src="http://ellyhosaka.sakura.ne.jp/webgl_car01/" frameborder="0" allowfullscreen></iframe>';
  echo '</div>';
  echo '<div class="key">Press →key: Rotate Right,　Press ←key: Rotate Left</div>';
}
else if($id==6){
  echo '<div class="web_gl">';
  echo '<iframe class="color" width="970" height="650" src="http://ellyhosaka.sakura.ne.jp/webgl_car02/" frameborder="0" allowfullscreen></iframe>';
  echo '</div>';
  echo '<div class="key">Press →key: Rotate Right,　Press ←key: Rotate Left</div>';
}
else if($id==7){
  echo '<div class="web_gl">';
  echo '<iframe class="color" width="970" height="650" src="http://ellyhosaka.sakura.ne.jp/webgl_stealth/" frameborder="0" allowfullscreen></iframe>';
  echo '</div>';
  echo '<div class="key">Press ↑key: Move Forward,　Press →key: Rotate Right,　Press ←key: Rotate Left</div>';
}
else if($id==8){
  echo '<div class="web_gl">';
  echo '<iframe class="color" width="970" height="650" src="http://ellyhosaka.sakura.ne.jp/webgl_kyoryu/" frameborder="0" allowfullscreen></iframe>';
  echo '</div>';
  echo '<div class="key">Press →key: Rotate Right,　Press ←key: Rotate Left<br>This is sound toy. Click on the "Push" button.</div>';
}

?>
   


<!-- フォームの始まり -->
<form action="cartadd.php" method="POST">
  <div class="outer">

    <!--商品本情報-->
    <div class="wrapper wrapper-item flex-parent">

      <main class="wrapper-main">

        <!--商品情報-->
        <!-- <p class="item-thumb"><img src="./img/<?=$row["fname"]?>" width="200"></p> -->
        <div class="item_content">
          <h2>Pick your favorite color and wite the color code.</h2>
          <table> 
            <tr>
               <td style="text-align:right;">Product Name:　</td><td><?=$row["item"]?></td>    
            <tr>
              <td style="text-align:right;">Color:　</td><td><input type="text" name="color" class="color_select" placeholder="ex.#fff000"></td>
            </tr>    
            <tr>
              <td style="text-align:right;">Price:　</td><td>US $<?=$row["value"]?></td>
            </tr> 
            <tr>
              <td style="text-align:right;">Quantity:　</td><td><input type="number" value="1" name="num"></td>
            </tr> 
            <tr>
              <td colspan="2">Do you have a coupon?</td>
            </tr> 
            <tr>
              <td style="text-align:right;">Coupon Code:　</td><td><input type="text" name="code"></td>
            </tr> 

          </table>                 
        </div>
 
        <!--カートボタン-->
        <div class="flex-parent item-label">
          <input type="submit" class="btn-cartin" value="Add to cart">
        </div>
        <!--商品詳細情報-->
        <!-- <div class="flex-parent item-label">
          <p class="item-text"><?=$row["description"]?></p>
        </div> -->
        <input type="hidden" name="item" value="<?=$row["item"]?>">
        <input type="hidden" name="value" value="<?=$row["value"]?>">
        <input type="hidden" name="id" value="<?=$row["id"]?>">
        <input type="hidden" name="fname" value="<?=$row["fname"]?>">
      </main>
    </div>
  </div>
</form>

<script src="http://code.jquery.com/jquery-3.0.0.js"></script>
</body>
</html>
