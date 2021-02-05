<html>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<body>

<?php include 'header.php';?>
<?php
$gender=$_POST["gender"];
$name=$_POST["name"];
$address=$_POST["address"];
$ageRange=$_POST["ageRange"];
$phoneNumber=$_POST["phoneNumber"];
$bagType=$_POST["bagType"];

$shippingPrice=$_POST["shippingPrice"];
$orderType=$_POST["orderType"];

$date=(date('Y')+543).(date('-m-d'));


	$sql = "INSERT INTO `$dbname`.`order` (`gender`,`name`,`ageRange`, `address`, `phoneNumber`,`bag`,`shippingPrice`,`orderBy`,`date`)
	VALUES ('$gender','$name','$ageRange', '$address', '$phoneNumber','$bagType','$shippingPrice','$orderType','$date')";
	if ($conn->query($sql) === TRUE) {
	    echo "
			<p style=\"font-size:36px;text-align:center;color:green;\">บันทึกข้อมูลสำเร็จ</p>
		";
	} else {
		echo "
			<p style=\"font-size:36px;text-align:center;color:red;\">บันทึกข้อมูลไม่สำเร็จ</p>
		";
	    echo "บันทึกไม่สำเร็จ: " . $sql . "<br>" . $conn->error;
	}

$conn->close();

?>

</body>
</html>

