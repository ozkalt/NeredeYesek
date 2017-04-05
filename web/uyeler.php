<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="generator" content="Responsive Site Designer 2.0.2044 - Trial Version">
  <title>Uyeler</title>
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
            <source media="screen" srcset="img/picture-2.svg"><!--[if IE 9]></video><![endif]--><img alt="Placeholder Picture" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
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
      <h1 class="heading-1">Grup Üyeleri</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <ul class="list-container">

<?php

include 'included.php';


$code="SELECT * from user";
$query=$handler->prepare($code);
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row) { ?>
<li class='list-item-container list-item-container-4'><button type='button' class='btn del_user' id='user_<?php echo $row['id'];?>'>Sil</button><span class='text-element text-6'><?php echo $row['name'];?></span></li>

<?php }?>
        
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 column-2">
      <h4 class="heading-2">Yeni Üye Ekle</h4>
    </div>
  </div>
  <div class="row row-2">
    <div class="col-xs-6 col-md-4">
      <span class="text-element text-4">İsim</span>
    </div>
    <div class="col-xs-3 col-md-4">
      <form class="form-container form-container-1" ><textarea name="text" class="textarea-1" id="new_user_name"></textarea>
      </form>
    </div>
    <div class="col-xs-3 col-md-4"><button type="button" id="add_user" class="btn">Ekle</button>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-3 col-md-4">
      <span class="text-element text-5">E-mail</span>
    </div>
    <div class="col-xs-3 col-md-4">
      <form class="form-container"><textarea name="textarea-name" class="textarea-2" id="new_user_mail"></textarea>
      </form>
    </div>
    <div class="col-xs-6 col-md-4"></div>
  </div>
  <div class="row">
    <div class="col-xs-12"></div>
  </div>
  <div class="row">
    <div class="col-xs-12"></div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/uyeler.js"></script>
  <script src="js/outofview.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>
