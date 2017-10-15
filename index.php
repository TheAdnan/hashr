<?php
	require_once("function.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Hashr</title>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<link href="main.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito|Orbitron" rel="stylesheet">
</head>
<body>
	<form name ="hashform" method="post" onsubmit="return validateform()">
		<label>Input string: </label>
		<input type="text" name="input" required oninvalid="this.setCustomValidity('You can\'t leave the input string blank!')">
		<input type="submit" name="submit" value="Hash!">
	</form>
	<br>
	<div class="hashes">
		<?php
			foreach (hash_algos() as $algo) { ?>
				<div class="hash_algo">
					<p class="algo"><b><?= $algo; ?></b></p>
					<p class="hash">Hash: <span style="font-family: Nunito"><?= $hashes[$algo]; ?></span></p>
                    <small>Execution time: <span class="exec-time" style="font-family: Nunito"><?= number_format($hashTime[$algo] * 1000000000, 0); ?> nanoseconds</span></small>
				</div>
		<?php	}
		 ?>
	</div>
</body>
</html>
