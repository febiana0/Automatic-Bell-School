<?php
	$konek = mysqli_connect("localhost","root","","bell");
	$sql = mysqli_query($konek, "select * from jam where status=1");
	if(mysqli_num_rows($sql) > 0)
	{
		echo "Bunyikan";
	}
?>