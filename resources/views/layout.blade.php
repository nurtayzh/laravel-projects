<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
	<style>
		.is-complete {
			text-decoration: line-through;
		}

		/*.button {
			background-image: linear-gradient(130deg, #6C52D9 0%, #1EAAFC 85%, #3EDFD7 100%);
			box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
		}*/
	</style>
</head>
<body>

	<div class="container" style="margin-top: 1em">
		@yield('content')
	</div>

</body>
</html>