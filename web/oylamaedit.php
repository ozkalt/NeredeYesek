<?php

include 'included.php';

	$name="";
	$data="";

	if(isset($_POST['user_name'])){
		$name=$_POST['user_name'];
		echo $name."\n";
	}
	if(isset($_POST['data'])){
		$data=$_POST['data'];
	}

	if($name!=""&&$data!=""){

		$userID=0;
		$code="SELECT id from user WHERE name=?";
		$query=$handler->prepare($code);
		$query->execute(array($name));
		foreach ($query->fetchAll(PDO::FETCH_COLUMN) as $row){
		$userID=$row;
		}

		$isPermittedPersonal=true;
		$code="SELECT isVoted from user WHERE id=? AND isVoted=1";
		$query=$handler->prepare($code);
		$query->execute(array($userID));
		foreach ($query->fetchAll(PDO::FETCH_COLUMN) as $row){
		$isPermittedPersonal=false;
		}

		if($isPermittedPersonal==true){

			$pairs=explode(";",$data);
			foreach ($pairs as $pair){

				$id_point=explode(",",$pair);
				echo "RestoranID:".$id_point[0]." "."Puan: ".$id_point[1]."\n";

				$oldPoint=0;

				$code="SELECT * from restaurant WHERE id=?";
				$query=$handler->prepare($code);
				$query->execute(array($id_point[0]));

				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				foreach($results as $row) {
					$oldPoint=$row['point'];
				}

				
				$code="UPDATE restaurant SET point=? WHERE id=?";
				$query=$handler->prepare($code);
				$query->execute(array(($id_point[1]+$oldPoint),$id_point[0]));
			}
			
			$code="UPDATE user SET isVoted=1 WHERE id=?";
			$query=$handler->prepare($code);
			$query->execute(array($userID));
			echo "Oylama Basarili";

		}else{
			echo "Zaten oylamissiniz, tekrar oylayamazsiniz!!";
		}

	}

/*
	$code="INSERT INTO user (name, mail) VALUES (?, ?)";
	$query=$handler->prepare($code);
	$query->execute(array($name,$mail));
*/

?>
