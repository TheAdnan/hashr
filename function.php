<?php
	$hashes = array();
	if(isset($_POST['submit']) && !empty($_POST['input'])){
		foreach (hash_algos() as $algo) {
			array_push($hashes, hash($algo, $_POST['input']));
		}
	}
?>