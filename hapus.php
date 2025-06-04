<?php
	$konek = mysqli_connect("localhost","root","","bell");
	$id = $_GET['id'];

	mysqli_query($konek,"delete from jam where id='$id'");
	echo "<script>location.replace('index.php');</script>";
?>