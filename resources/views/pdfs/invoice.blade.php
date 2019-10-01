<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		.container{
			margin-right: auto;
			margin-left: auto;
			width: 100%;
		}
		.header {
			text-align: right;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="header">
			<h2 class="uppercase"><b>Invoice</b></h2>
			<p class="header-p"><span class="light-blue" style="margin-right: 12px;">Reference:</span> {{ $ref }}</p>
			<p class="header-p"><span class="light-blue" style="margin-right: 18px;">Billing Date:</span> {{ $billing_date }}</p>
			<p lass="header-p"><span class="light-blue" style="margin-right: 34px;">Due Date:</span> {{ $due_date }}</p>
		</div>
	</div>

</body>
</html>