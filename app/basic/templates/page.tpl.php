<!doctype html>
<html lang='sv'>
	<head>
		<meta charset='utf-8'/>
		<title><?php if(isset($this->title)) echo $this->title?></title>
	</head>

	<body>
		<div id='wrapper'>

		<header id='header'>
			<p>Här hamnar nav och header</p>
			<?php if(isset($this->nav)) echo $this->nav?>
		</header>

		<main>

			<?php if(isset($this->main)) echo $this->main?>

		</main>


		<footer>
			<p>Här hamnar footern</p>
		</footer>

		</div>




	</body>
</html>
