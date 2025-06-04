<?php
$konek = mysqli_connect("localhost", "root", "", "bell");
mysqli_query($konek, "UPDATE jam SET status=0 WHERE status=1");
?>
