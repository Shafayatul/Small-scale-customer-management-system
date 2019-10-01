<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		* {
		  box-sizing: border-box;
		}

		.col-1 {width: 8.33%;}
		.col-2 {width: 16.66%;}
		.col-3 {width: 25%;}
		.col-4 {width: 33.33%;}
		.col-5 {width: 41.66%;}
		.col-6 {width: 50%;}
		.col-7 {width: 58.33%;}
		.col-8 {width: 66.66%;}
		.col-9 {width: 75%;}
		.col-10 {width: 83.33%;}
		.col-11 {width: 91.66%;}
		.col-12 {width: 100%;}

		[class*="col-"] {
		  float: left;
		  /*padding: 10px;*/
		  border: none;
		}

		.row::after {
		  content: "";
		  clear: both;
		  display: table;
		}

		html {
		  font-family: "helvetica", sans-serif;

		}
		h1,h2,h3,h4,h5,h6 p {
			margin: 0px;
		}

		.container{
			margin-right: auto;
			margin-left: auto;
			width: 100%;
			padding: 30px;
		}

		.text-right{
			text-align: right;
		}
		.ltr{
			direction: ltr;
		}

		.uppercase{
			text-transform: uppercase;
		}
		.header-p{
			line-height: 10px;
			font-size: 14px;
		}

		.light-blue{
			color: #17579F;
			font-weight: bolder;
			font-size: 14px;
		}

		.float-right{
			float: right;
		}

		.float-left{
			float: left;
		}

		.hr-with-margin{
			width: 100%;
			color: #17579F;
		}

		.hr-without-margin{
			width: 100%;
			color: #17579F;
		}

		table {
		  width: 100%;
		  border-collapse: collapse;
		}

		.border-bottom{
			/*border: none;*/
			border-bottom: 1px solid #17579F!important;
		}

		.billing-info{
			margin-left: 10%;
		}
		.p-style {
			font-size : 12px;
			color : #808080;
			line-height: 20px;
		}
		.p-style-2 {
			font-size : 14px;
			color : #4A4545;
			line-height: 20px;
		}

		.info-bill-text {
			color : #4d5157;
			margin-top: 20px;
		}
		h3 {
			font-size: 14px;

		}
		table.product-table tr{
  border:1px solid red;
}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12 text-right">
				<h2 class="uppercase"><b>Invoice</b></h2>
				<p style=" line-height: 10px !important; font-size: 12px !important; margin-top: 20px; margin-bottom: 0px;" class="header-p uppercase"><span class="light-blue" style="margin-right: 12px; padding-right: 24px;">Reference:</span> <span class="p-style-2">{{ $ref }}</span></p>
				<p style=" line-height: 10px !important; font-size: 12px !important; margin-bottom: 0px;" class="header-p"><span class="light-blue uppercase" style="margin-right: 18px; text-align: left; padding-right: 20px;">Billing Date:</span> <span class="p-style-2">{{ $billing_date }}</span></p>
				<p style=" line-height: 10px !important; font-size: 12px !important; margin-bottom: 0px;" class="header-p"><span class="light-blue uppercase" style="margin-right: 34px; text-align: left; padding-right: 26px;">Due Date:</span> <span class="p-style-2">{{ $due_date }}</span></p>
			</div>
		</div>
		<div class="row" style="margin-top: 50px;">
			<div class="col-6">
				<h3 class="light-blue">OUR INFORMATION</h3>
				<hr class="hr-with-margin">
				<h4 class="info-bill-text">Devyn Earls, Inc.</h4>
				<p class="p-style">4446-1A Hendricks Ave., Ste 224</p>
				<p class="p-style">Jacksonville, FL 32207</p>
			</div>
			<div class="col-6 float-right">
				<div class="billing-info">
					<h3 class="light-blue">BILLING TO</h3>
					<hr class="hr-without-margin">
					<h4 class="info-bill-text">{{ $customer->business_name }}</h4>
					<p class="p-style">{{ $customer->address }}</p>
					<p class="p-style">{{ $customer->city.','.$customer->state.','.$customer->zip }}</p>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 50px;">
			<div class="col-12">
				<table>
					<tr>
						<td style="font-weight: bold; color: #323232; font-size: 14px;">PRODUCT</td>
						<td></td>
						<td></td>
						<td></td>
						<td class="text-right" style="font-size: 14px; padding-right: 10px; color: #323232; font-weight: bold;">TOTAL</td>
					</tr>
				</table>
				<div class="" style="width: 100%; height: 1px; background: #17579F; margin: 10px 0px 10px 0px;">

				</div>
				<table>

						<tr>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
						</tr>
					@foreach($products as $product)
						<tr>
							<td style="width: 58%; background-color: #f0f0f0; height: 50px; margin-top: 20px; margin-left: 10px; padding-left: 15px; padding-top: 10px;">
								<h5>{{ $product->product_name }}</h5>
								<p class="p-style"></p>
							</td>
							<td style="width: .1%; background-color: #fff; height: 50px; margin-top: 20px;"></td>
							<td style="width: 25%; background-color: #f0f0f0; height: 50px; margin-top: 20px; text-align: center;"><p class="p-style">{{ $product->description }}</p></td>
							<td style="width: .1%; background-color: #fff; height: 50px; margin-top: 20px;"></td>
							<td style="width: 12%; background-color: #f0f0f0; height: 50px; margin-top: 20px; text-align: center;"><p class="p-style">{{ $product->amount }}</p></td>
						</tr>
					@endforeach
					<tr>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
						</tr>
				</table>

				<table>
					<tr>
						<td style="width: 74.8%; height: 30px;"></td>
						<td style="width: .07%; background-color: #fff; height: 30px;"></td>
						<td style="width: 12.5%; background-color: #07569E; color: #fff; height: 30px; text-align: center; font-size : 12px; font-weight: bold;">Total Due</td>
						<td style="width: .07%; background-color: #fff; height: 30px;"></td>
						<td style="width: 12.5%; background-color: #07569E; color: #fff; height: 30px; text-align: center; font-size : 12px; font-weight: bold;">${{ $products->sum('amount') }}</td>
					</tr>
				</table>

				<div class="row" style="margin-top: 60px;">
					<div class="col-12">
						<table>
							<tr>
									<td style="font-weight: bold; color: #323232; font-size: 14px;">PAYMENT INFORMATION</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
						</table>
						<div class="" style="width: 100%; height: 1px; background: #17579F; margin: 10px 0px 10px 0px;">

						</div>

						<div class="payment-info-desc">
							<p class="p-style">Make all checks payable to: Devyn Earls, Inc <br>
								You can pay online with an additional 3% convience fee on my website: https://www.devynearlsinc.com</p>
							<p class="p-style">If you have any questions concerning this invoice, contact me at devyn@dewebdesigns.com</p>
							<p class="p-style">Thank you for your business.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

