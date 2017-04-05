<?php

include 'included.php';

if(isset($_POST['type'])){
    $type=$_POST['type'];
}

if($type=='delete'){
$id=0;
	if(isset($_POST['restoransil'])){
	    $id=$_POST['restoransil'];
	    $id=substr($id,11);
	}

	$code="UPDATE restaurant SET state=0 WHERE id=?";
	$query=$handler->prepare($code);
	$query->execute(array($id));
}else if($type=='add'){

	$name="";
	$distance=0;
	$condition=0;

	if(isset($_POST['new_restaurant_name'])){
		$name=$_POST['new_restaurant_name'];
		echo $name."\n";
	}
	if (isset($_POST['transport_yaya'])) {
		if ($_POST['transport_yaya']=='1') {
			$distance = 1;
		}
	}
	if (isset($_POST['transport_araba'])) {
		if ($_POST['transport_araba']=='1') {
			if($distance==1){
				$distance = 3;
			}else if($distance==0){
				$distance = 2;
			}
		}
	}
	if (isset($_POST['new_restaurant_sensitiveness'])){
		if ($_POST['new_restaurant_sensitiveness']=='1'){
			$condition=1;
			echo "yagmurlu hava durumu ".$condition;
		}
	}

	$code="INSERT INTO restaurant (name, distance, sensitiveness, point, state) VALUES (?, ?, ?, 0, 1)";
	$query=$handler->prepare($code);
	$query->execute(array($name,$distance,$condition));

}

?>
