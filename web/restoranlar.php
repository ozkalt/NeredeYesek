<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="generator" content="Responsive Site Designer 2.0.2044 - Trial Version">
  <title>Restoranlar</title>
  <link rel="stylesheet" href="css/bootstrap4.min.css">
  <link rel="stylesheet" href="css/wireframe-theme.min.css">
  <script>document.createElement( "picture" );</script>
  <script src="js/picturefill.min.js" class="picturefill" async="async"></script>
  <link rel="stylesheet" href="css/main.css">
</head>

<body class="grid-1">
  <div class="row row-1">
    <div class="col-xs-2">
      <div class="responsive-picture picture-2">
        <picture onclick="window.location='anasayfa.php'"><!--[if IE 9]><video style="display: none;"><![endif]-->
          <source srcset="./myphoto/logooo.png" media="(min-width: 768px)">
            <source media="screen" srcset="img/picture.svg"><!--[if IE 9]></video><![endif]--><img alt="Placeholder Picture" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
        </picture>
      </div>
    </div>
    <div class="col-xs-2"></div>
    <div class="col-xs-8 custom-575-offset-xs-0 custom-575-push-xs-1 custom-575-pull-xs-0 pull-md-0 push-md-2"><a class="link-button btn" href="uyeler.php">Üyeler</a><a class="link-button btn" href="restoranlar.php">Restoranlar</a><a class="link-button btn" href="oylama.php">Oylama</a>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12"></div>
  </div>
  <div class="row">
    <div class="col-xs-12 custom-575-offset-xs-0">
      <h1 class="heading-1">Restoranlar</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <ul class="list-container">

<?php

include 'included.php';

$code="SELECT * FROM restaurant WHERE state=1";
$query=$handler->prepare($code);
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row) { ?>
<li class='list-item-container list-item-container-4'><button type='button' class='btn del_restaurant' id='restaurant_<?php echo $row['id'];?>'>Sil</button><span class='text-element text-6'><?php echo "Adi: ".$row['name']."\t - Puani:".$row['point']." ";?></span></li>

<?php }?>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 column-2">
      <h4 class="heading-2">Yeni Restoran Ekle</h4>
    </div>
  </div>
  <div class="row row-2">
    <div class="col-xs-6 col-md-4">
      <span class="text-element text-4">Restoran adı</span>
    </div>
    <div class="col-xs-3 col-md-4">
      <form class="form-container form-container-1"><textarea id="new_restaurant_name" name="text" class="textarea-1"></textarea>
      </form>
    </div>
    <div class="col-xs-3 col-md-4"><button type="button" id="add_restaurant" class="btn">Ekle</button>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-3 col-md-4">
      <span class="text-element text-5">Ulaşım Tipi</span>
    </div>
    <div class="col-xs-3 col-md-4"><label class="checkbox checkbox-2"><input  type="checkbox" name="" id="transport_yaya" value="yaya"><span>Yaya</span></label><label class="checkbox checkbox-1"><input type="checkbox" name="" id="transport_araba" value="araba"><span>Araba</span></label>
    </div>
    <div class="col-xs-6 col-md-4"></div>
  </div>
  <div class="row">
    <div class="col-xs-12"><label class="checkbox checkbox-3"><input type="checkbox" name="" value="raincheck" id="new_restaurant_sensitiveness" ><span>Yağmurlu havalar için uygun</span></label>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12"></div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/restoranlar.js"></script>
  <script src="js/outofview.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
