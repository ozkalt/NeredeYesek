<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="generator" content="Responsive Site Designer 2.0.2044 - Trial Version">
  <title>Oylama</title>
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
            <source media="screen" srcset="img/picture-1.svg"><!--[if IE 9]></video><![endif]--><img alt="Placeholder Picture" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
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
  <div class="row row-3">
    <div class="col-xs-6">
      <span class="text-element text-9">İsim</span>
    </div>
    <div class="col-xs-6">
	<select id="user_name" name="text-name">
<?php
include 'included.php';
$code="SELECT * FROM user";
$query=$handler->prepare($code);
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row) {
echo '<option value = "'.$row['name'].'" >'.$row['name'].'</option>';
}
?>
	</select>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 custom-575-offset-xs-0">
      <h1 class="heading-1">Restoranlar</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <ul class="list-container list-container-1">
        
<?php


$isPermittedGeneral=false;

$code="SELECT permitted from isVotePermitted WHERE permitted=1";
$query=$handler->prepare($code);
$query->execute();
foreach ($query->fetchAll(PDO::FETCH_COLUMN) as $row){
$isPermittedGeneral=true;
}

$code="SELECT * from restaurant WHERE state=1";
$query=$handler->prepare($code);
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row) { ?>
<li class='list-item-container list-item-container-1'>
<span class='text-element text-1'><?php echo $row['name'];?></span>
<input value="" name="text-name" type="text" class="input-2 restaurant_points" id='restaurant_points_<?php echo $row['id'];?>'>
</li>

<?php }
if ($isPermittedGeneral==false){
echo "<script>alert('Oylama suresi icerisinde olmadiginizdan oylayamazsiniz. Anasayfaya yonlendiriliyorsunuz.');window.location='anasayfa.php'</script>" ;}
?>
        
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12"><button type="button" id="oylama" class="btn">Oyla</button>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/oylamalar.js"></script>
  <script src="js/outofview.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>
