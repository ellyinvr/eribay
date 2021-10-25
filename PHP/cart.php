<?php
session_start();
//----------------------------------------------------
//1．SESSIONからカートを取得
//※カートSESSION: array([0]=item,[1]=value,[2]=num,[3]=fname);
//----------------------------------------------------
$view ='';
$sum = 0;
$subtotal = 0;
$sumQ = 0;

//$_SESSION["cart"]のデータを取得
foreach($_SESSION["cart"] as $key => $value){

  $subtotal = $value[1]* $value[2];                         
  $sum = $sum + $subtotal;
  $sumQ +=  $value[2];
      $view .='<tr>';
      $view .='<td><p class="cart-thumb"><img src="./img/'.$value[3].'" width="100" ></p></td>';
      $view .='<td><p class="cart-title">'.$value[0].'</p></td>';
      $view .='<td><p class="cart-color">'.$value[4].'</p></td>';
      $view .='<td><p class="cart-number">'.$value[2].'</p></td>';
      $view .='<td><p class="cart-price">US $'.$value[1].'</p></td>';
      $view .='<td><p><a href="cartremove.php?id='.$key.'" class="btn-delete"><i class="las la-trash-alt"></i></a></p></td>'; //$key
      $view .='</tr>';

}

$sumc = $sum*0.8;
if($value[5] == "eri"){
      $view .='<tr>';
      $view .='<td></td>';
      $view .='<td></td>';
      $view .='<td>Total</td>';
      $view .='<td>'.$sumQ.'</td>';
      $view .='<td>US $'.$sum.'</td>';
      $view .='<td></td>';
      $view .='</tr>';
      $view .='<tr>';
      $view .='<td></td>';
      $view .='<td></td>';
      $view .='<td></td>';
      $view .='<td style="color:red;">20% discount</td>';
      $view .='<td style="color:red;">US $'.$sumc.'</td>';
      $view .='<td></td>';
      $view .='</tr>';
}
else if($value[5] !== "eri" || $value[5] !== ""){
  $view .='<tr>';
      $view .='<td></td>';
      $view .='<td></td>';
      $view .='<td>Total</td>';
      $view .='<td>'.$sumQ.'</td>';
      $view .='<td>US $'.$sum.'</td>';
      $view .='<td></td>';
      $view .='</tr>';
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <!-- <link rel="stylesheet" href="css/reset.css"> -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/jquery.bxslider.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Hind&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <style>
    body{
      font-family: 'Hind', sans-serif;
    }
    td{
      font-size:18px;
      width:200px;
      text-align:center;
      /* padding:0 50px 10px 50px; */
    }

    li{
      list-style: none;
    }
    .btn-delete i{
      font-size:25px;
    }
    table{
      border-collapse: collapse;
      margin:0 auto 40px auto;
    }
   table td{
   border-bottom: 0.6px solid lightgray;
   }
   .btn-list{
	 display: flex;
	 justify-content:space-between;
   }
  .btn-item{
    display: block;
    padding:20px;
    font-size: 2rem;
  }
  .btn-buy{
    
    /* border:none; */
    text-decoration: none;
  }
  .btn-buy a{
    color: #696969;
    text-decoration: none;
  }
  .btn-calculate>a{
    background: #e7108e;
    color: #fff;
    padding:10px;
    text-decoration: none;
  }
  .btn-calculate{
    margin-right:55px;
  }
  .page-title{
	margin-bottom: 80px;
	font-size: 4rem;
	text-align: center;
}
  </style>
</head>
<body>

  <div class="outer">
    <h1 class="page-title">Shopping Cart</h1>
    <div class="wrapper wrapper-main flex-parent">
      <main class="wrapper-main">

        <table>
        <tr>
          <td></td>
          <td>Name</td>
          <td>Color</td>
          <td>Qty</td>
          <td>Price</td>
          <td></td>
        </tr>
 
        <?php
          //表示
          echo $view;
        ?>

        </table>

       

        <ul class="btn-list">
          <li class="btn-item btn-buy"><a href="index.php">←　Continue shopping</a></li>
          <li class="btn-item btn-calculate"><a href="http://ellyhosaka.sakura.ne.jp/webgl_eribay/">Buy it now</a></li>
        </ul>
      </main>
    </div>
  </div>

<script src="http://code.jquery.com/jquery-3.0.0.js"></script>
</body>
</html>
