<?php 
if(isset($_POST['update_booking']) {

		$name = $_POST['name'];
		$contact_no = $_POST['contact'];
		$date_in = $_POST['date_in'];

		$out= date("Y-m-d H:i",strtotime($date_in.' '.$date_in_time.' +'.$days.' days'));

		$noofroom = $_POST['noofroom']; 
		$date_in_time = $_POST['date_in_time'];

		$booked_cid = $_POST['cid'];

		$i = 1;
		while($i== 1){
			$ref  = sprintf("%'.04d\n",mt_rand(1,9999999999));
			if($this->db->query("SELECT * FROM checked where ref_no ='$ref'")->num_rows <= 0)
				$i=0;
		}
		$data .= ", ref_no = '$ref' ";

		echo $ref;
		echo $name;
		echo $contact_no;
		echo $date_in;
		echo $out;
		echo $booked_cid;
		echo $noofroom;
		exit();
		
		$q = "INSERT INTO `checked`(`ref_no`, `name`, `contact_no`, `date_in`, `date_out`, `booked_cid`, `noofroom`) VALUES ('$ref','$name', '$contact_no', '$date_in', '$out' , '$booked_cid' , '$noofroom')";
		$stmt=$conn->prepare($q);
		$stmt->execute();
 
		$conn=null;

		if ($stmt) {

			$query = "SELECT * FROM `tbl_events` WHERE `start` BETWEEN '$date_in' AND '$out' and `end` BETWEEN '$date_in' AND '$out'";
			include '../config.php';
			$stmt=$conn->prepare($query);
			$stmt->execute();
			$result=$stmt->fetchAll();
			$conn=null;

			foreach($result as $room){
				$id2 = $room['id'];

				$query2 = "UPDATE `tbl_events` SET `title`= `title`- $noofroom WHERE `id` = $id2";
				include '../config.php';
				$stmt2=$conn->prepare($query2);
				$stmt2->execute();
                             // $result2=$stmt2->fetchAll();
				$conn=null;  

				if ($stmt2) {
					header('location: ../list.php');
				}                       
			}
		}else{
			header('location: ../index.php');
		}
				
}
