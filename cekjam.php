<?php
	date_default_timezone_set("Asia/Jakarta");
	$jam = date('H:i:s');
	echo $jam;

	$konek = mysqli_connect("localhost","root","","bell");
	$sql = mysqli_query($konek, "select * from jam order by id asc");
	while($data = mysqli_fetch_array($sql))
	{
		$id = $data['id'];
		$jamdb = $data['jam'];

		if ($jam == $jamdb) {
			mysqli_query($konek, "update jam set status=1 where id='$id'");
		}
	}
?>