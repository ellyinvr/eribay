<?php
session_start();
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=ellyhosaka_unit2;charset=utf8;host=mysql57.ellyhosaka.sakura.ne.jp','ellyhosaka','Eri-93149314');
  // $pdo = new PDO('mysql:dbname=playcolor;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．データ抽出SQL作成
$stmt = $pdo->prepare("SELECT * FROM ec_table");
$status = $stmt->execute();


//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<div class="products-item">';
    $view .= '<a href="item.php?id='.$result["id"].'">';
    $view .= '<div class="pruducts-thumb"><img src="./img/'.$result["fname"].'" width="550"></div>';
    $view .= '<div class="products-title"><p>'.$result["item"].'</p>';
    $view .= '<p class="products-price">US $'.$result["value"].'</p></div>';
    $view .= '</a>';
    $view .= '</div>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>eribay</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/jquery.bxslider.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Hind&display=swap" rel="stylesheet">
  <style>
  body{
    font-family: 'Hind', sans-serif;
    background-color:black;
    margin:0;
  }
  i {color:white; font-size:40px;}
  .d {font-size:20px;}
  .btn-user {
    padding-left:20px;
    color:white; 
    font-size:20px;
  }
  .header{
    height:7rem;
  }
  .header h1 a,.footer h1 a{
    color:white; 
    font-size:40px; 
    text-decoration:none;
    font-family: 'Hind', sans-serif;
  }
  .header a{
    text-decoration:none;
    color:white;
  }
  
  .footer a{
    text-decoration:none;
  }
  .eri{
    color:deeppink;
  }
  .b{
    color: deepskyblue;
  }
  .a{
    color:yellow;
  }
  .y{
    color:lightgreen;
  }
  .wrapper-main h1{
    color:white;
    font-size:35px; 
    padding-bottom:15px;
  }
  .video_content video{
    width:100%;
    margin-bottom:80px;
  }
  .products-title p{
	margin:0;
}
	
.products-price{
	margin:0;
}

.sumq{
  color:white;
}

.discount{
  margin:0 auto;
  color:white;
  width:1300px;
  height: 180px;
  background-color:deeppink;
  margin-bottom:80px;
}
.discount h1{
  font-size:3rem;
  padding: 20px 0 0 50px;
}

.discount p{
  font-size:2rem;
  padding-left:50px;
  font-weight:bold;
}

.discount span{
  border-bottom:1px solid white;
}
.pruducts-thumb{
  background: #000;
}
.pruducts-thumb img:hover {
	transform: scale(1.1);	/*画像の拡大率*/
	transition-duration: 0.3s;	/*変化に掛かる時間*/
  opacity: 0.6;
}

  </style>
</head>
<body>
  <p></p>
  <header class="header">

    <h1 class="site-title"><a href="#"><span class="eri">eri</span><span class="b">b</span><span class="a">a</span><span class="y">y</span><span class="d">3D</span></a></h1>
    <a href="#" class="btn btn-user"><i class="las la-user-circle"></i>Hi!</a>
    <a href="cart.php" class="btn btn-cart"><i class="las la-shopping-cart"></i>
    <span class="cartnum" style="font-size:20px;"><?php 
      $sumQ = 0;
      foreach($_SESSION["cart"] as $key => $value){
      $sumQ +=  $value[2];}
      if($sumQ !== 0){
      echo($sumQ); }
    ?></span>
  </a>
    <!-- <a href="#" class="btn btn-menu"><img src="images/common/icon-menu.png" alt=""></a> -->
  </header>

  <div>
    <!-- <ul class="bxslider"> -->

    <div class="video_content">
        <video src="eribay3.mov" autoplay muted loop></video>
　  </div>
      <!-- <li><img src="images/index/slide.jpg" alt=""></li> -->
      <!-- <li><img src="images/index/slide.jpg" alt=""></li>
      <li><img src="images/index/slide.jpg" alt=""></li>
      <li><img src="images/index/slide.jpg" alt=""></li>
      <li><img src="images/index/slide.jpg" alt=""></li> -->
    <!-- </ul> -->
  </div>

    <div class="discount">
      <h1>Grab 20% off! It's time to save.</h1>
      <p>Shop 'til you drop with offers on selected customers. Ends 10 July.
      <br><span>Use Code: eri</span></p>
    </div>
   
    <div class="wrapper wrapper-main flex-parent">
      <main class="wrapper-main">
        <h1>Popular Items</h1>

        <!--商品リスト-->
        <ul class="products-list">
            <?php echo $view; ?>
        </ul>
        <!--end 商品リスト-->
      </main>
    </div>
  

  <!--footer-->
  <footer class="footer">
    <div class="wrapper wrapper-footer">

      <div class="footer-widget__long">
        <h1 class="site-title"><a href="#"><span class="eri">eri</span><span class="b">b</span><span class="a">a</span><span class="y">y</span><span class="d">3D</span></a></h1>
      </div>

      <div class="footer-widget">
        <ul class="nav-footer">
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
        </ul>
      </div>

       <div class="footer-widget">
        <ul class="nav-footer">
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
        </ul>
      </div>

      <div class="footer-widget">
        <ul class="nav-footer">
          <li class="nav-footer__item"><a href="#">Why eribay?</a></li>
          <li class="nav-footer__item"><a href="#">Contact Us</a></li>
          <li class="nav-footer__item"><a href="#">Cart</a></li>
          <li class="nav-footer__item"><a href="#">Member Page</a></li>
        </ul>
      </div>

      <div class="footer-widget">
        <ul class="social-list">
          <li class="social-item"><a href="#"><img src="images/common/facebook.png" alt=""></a></li>
          <li class="social-item"><a href="#"><img src="images/common/instagram.png" alt=""></a></li>
          <li class="social-item"><a href="#"><img src="images/common/twitter.png" alt=""></a></li>
        </ul>
      </div>

    </div>
    <p class="copyrights"><small>Copyrights eribay All Rights Reserved.</small></p>
  </footer>
  <!--end footer-->

<script src="http://code.jquery.com/jquery-3.0.0.js"></script>
<script src="js/jquery.bxslider.min.js"></script>
<script>
  $(".bxslider").bxSlider({auto:true,options:3000});
</script>
</body>
</html>
