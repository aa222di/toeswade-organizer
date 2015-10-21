<!doctype html>
<html lang='sv'>
	<head>
		<meta charset='utf-8'/>
		<title>Test</title>
	</head>

	<body>
		<div id='wrapper'>

		<header id='header'>
			<p>Här hamnar nav och header</p>
			<?php if(isset($nav)) echo $nav?>
		</header>

		<main>

			<?php if(isset($main)) echo $main?>

		</main>


		<footer>
			<p>Här hamnar footern</p>
		</footer>

		</div>




	</body>
</html>
