<?php
	require_once("function.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hashr</title>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito|Orbitron" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
	<header class="headform card">
		<form method="post">
			<label class="form-label">Input string: </label>
			<input type="text" name="input" class="form-input" placeholder="Enter your input String">
			<input type="submit" name="submit" value="hash!">
		</form>
	</header>
	<?php
			foreach (hash_algos() as $i => $algo) { ?>
				<article class="item-card card">
					<span class="algo_name"><?= $algo; ?></span>
					<p>Hash: <span class="text_style"><?= $hashes[$i]; ?></span></p>
				</article>
		<?php	}
		 ?>
</div>
</body>
</html>
