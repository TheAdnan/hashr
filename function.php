<?php
	$hashes = array();
	$hashTime = array();
	if(isset($_POST['submit']) && !empty($_POST['input'])){
		foreach (hash_algos() as $algo) {

            $start = microtime(true);
		    $hash = hash($algo, $_POST['input']);
            $timeElapsed = microtime(true) - $start;
            $hashTime[$algo] = $timeElapsed;
			$hashes[$algo] = $hash;
		}
	}
?>