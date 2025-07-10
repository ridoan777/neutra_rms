<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="/resources/css/flowbite_custom.css">
	<style>
		p{
			color: red;
		}
		.method{
			color: green;
		}
		.bg-yellow-500{
			background-color: yellow;
		}
	</style>
</head>

<body>
	sfsa
	<p>{{ $singleRecord->item_1 }}</p>
	<div class="method bg-yellow-500">{{ $singleRecord->method }}</div>
</body>

</html>