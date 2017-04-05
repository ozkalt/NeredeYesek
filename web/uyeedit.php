<?php

include 'included.php';

if(isset($_POST['type'])){
    $type=$_POST['type'];
}

if($type=='delete'){
$id=0;
	if(isset($_POST['uyesil'])){
	    $id=$_POST['uyesil'];
	    $id=substr($id,5);
	}

	$code="DELETE FROM user WHERE id=?";
	$query=$handler->prepare($code);
	$query->execute(array($id));
}else if($type=='add'){

	$name="";
	$mail="";

	if(isset($_POST['new_user_name'])){
		$name=$_POST['new_user_name'];
		echo $name."\n";
	}
	if(isset($_POST['new_user_mail'])){
		$mail=$_POST['new_user_mail'];
		echo $mail."\n";
	}

	$code="INSERT INTO user (name, mail) VALUES (?, ?)";
	$query=$handler->prepare($code);
	$query->execute(array($name,$mail));

}

?>
