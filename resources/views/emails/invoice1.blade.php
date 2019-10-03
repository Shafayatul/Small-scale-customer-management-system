<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		* {
		  box-sizing: border-box;
		}
		body {
			font-family: Arial, Helvetica, sans-serif;
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

		h1,h2,h3,h4,h5,h6 p {
			margin: 0px;
		}
		h1,h2,h3,h4,h5,h6 p {
			margin: 0px;
		}

		.container{
			margin-right: auto;
			margin-left: auto;
			width: 100%;
			padding: 22px 32px 22px 30px;
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
			/ font-size: 14px; /
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
			color : #606060;
			line-height: 18px;
			/ padding-left: 5px; /
			margin: 6px;
		}
		.p-style-2 {
			font-size : 14px;
			color : #302124;
			line-height: 20px;
			font-weight: 500 !important;
		}

		.info-bill-text {
			color : #3A3232;
			margin-top: 20px;
			font-size: 13px;
			padding-left: 5px;
			margin-bottom: 0px;
			color : #808080;
			line-height: 20px;
		}
		h3 {
			font-size: 14px;

		}
		table.product-table tr{
  		border:1px solid red;
		}
		.underline {
			width: 100%;
			height: 1.5px;
			background: #07569E;
			opacity: .6;
			margin-top: 10px;
		}
	</style>
</head>
<body style="width: 100%; display: block; overflow: hidden; max-width: 600px; margin: 0 auto !important; background-color: #ffffff;">
	<div class="container">
		<div class="row">
			<div class="col-12 text-right">
				<h2 class="uppercase" style="font-weight: 1000 !important; font-size: 26px; text-align: right !important;"><b>Invoice</b></h2>
				{{-- <p style=" line-height: 7px !important; font-size: 12px !important; margin-top: 20px; margin-bottom: 0px;" class="header-p uppercase">
					<span class="light-blue" style="font-size: 20px; font-weight:800 !important; margin-right: 12px; padding-right: 24px;">Reference:</span>
					<span class="p-style-2">{{ $ref }}</span>
				</p>
				<p style=" line-height: 7px !important; font-size: 12px !important; margin-bottom: 0px;" class="header-p">
					<span class="light-blue uppercase" style="font-size: 20px; font-weight:800 !important; margin-right: 18px; text-align: left; padding-right: 20px;">Billing Date:</span>
					<span class="p-style-2">{{ $billing_date }}</span>
				</p>
				<p style=" line-height: 7px !important; font-size: 12px !important; margin-bottom: 0px;" class="header-p">
					<span class="light-blue uppercase" style="font-size: 20px; font-weight:800 !important; margin-right: 34px; text-align: left; padding-right: 26px;">Due Date:</span>
					<span class="p-style-2">{{ $due_date }}</span>
				</p> --}}
				<div class="row">
					<div class="col-10">
						<p style=" line-height: 7px !important; font-size: 12px !important  font-weight:800 !important; margin-top: 20px; margin-bottom: 0px;  margin-right: 12px; padding-right: 24px; text-align:right !important;" class="header-p uppercase light-blue">Reference:
						</p>
						<p style=" line-height: 7px !important; font-size: 12px !important  font-weight:800 !important; margin-top: 20px; margin-bottom: 0px;  margin-right: 12px; padding-right: 24px; text-align:right !important;" class="header-p uppercase light-blue">Billing Date:
						</p>
						<p style=" line-height: 7px !important; font-size: 12px !important  font-weight:800 !important; margin-top: 20px; margin-bottom: 0px;  margin-right: 12px; padding-right: 24px; text-align:right !important;" class="header-p uppercase light-blue">Due Date:
						</p>
					</div>
					<div class="col-2">
						<p style=" line-height: 7px !important; font-size: 12px !important; margin-top: 20px; margin-bottom: 0px; color : #302124; font-weight: 500 !important; text-align: right !important;" class="header-p uppercase p-style-2">{{ $ref }}
						</p>
						<p style=" line-height: 7px !important; font-size: 12px !important; margin-top: 20px; margin-bottom: 0px; color : #302124; font-weight: 500 !important; text-align: right !important;" class="header-p uppercase p-style-2">{{ $billing_date }}
						</p>
						<p style=" line-height: 7px !important; font-size: 12px !important; margin-top: 20px; margin-bottom: 0px; color : #302124; font-weight: 500 !important; text-align: right !important;" class="header-p uppercase p-style-2">{{ $due_date }}
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 60px;">
			<div class="col-5">
				<h3 class="light-blue" style="font-size : 13px; padding-left : 5px;">OUR INFORMATION</h3>
				<div class="underline"></div>
				<h4 class="info-bill-text">Devyn Earls, Inc.</h4>
				<p class="p-style" style="font-size: 11px; padding-left: 5px;">4446-1A Hendricks Ave., Ste 224 <br> Jacksonville, FL 32207</p>
			</div>
			<div class="col-7 float-right">
				<div class="billing-info">
					<h3 class="light-blue" style="font-size : 13px; padding-left : 5px;">BILLING TO</h3>
					<div class="underline"></div>
					<h4 class="info-bill-text">{{ $customer->business_name }}</h4>
					<p class="p-style" style="font-size: 11px; padding-left: 5px;">{{ $customer->address }} <br> {{ $customer->city.','.$customer->state.','.$customer->zip }} </p>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 40px;">
			<div class="col-12">
				<table>
					<tr>
						<td style="font-weight: bold; color: #323232; font-size: 13px; padding-left: 5px;">PRODUCT</td>
						<td></td>
						<td></td>
						<td></td>
						<td class="text-right" style="font-size: 13px; padding-right: 10px; color: #323232; font-weight: bold;">TOTAL</td>
					</tr>
				</table>
				<div class="" style="width: 100%; height: 1px; background: #17579F; margin: 10px 0px 5px 0px;">

				</div>
				<table>

						<tr>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
						</tr>
					@foreach($products as $product)
						<tr>
							<td style="width: 58%; background-color: #f0f0f0; height: 50px; margin-top: 0px; margin-left: 10px; padding-left: 8px; padding-top: 0px;">
								<h5 style="font-size : 11px; color: #3A3232">{{ $product->product_name }}</h5>
								<p class="p-style" style="margin: 0px !important; padding-top: 5px; font-size: 10px;">aaaaaaaaaaaa</p>
							</td>
							<td style="width: .1%; background-color: #fff; height: 50px; margin-top: 20px;"></td>
							<td style="width: 25%; background-color: #f0f0f0; height: 50px; margin-top: 20px; text-align: center;"><p class="p-style">{{ $product->description }}</p></td>
							<td style="width: .1%; background-color: #fff; height: 50px; margin-top: 20px;"></td>
							<td style="width: 12%; background-color: #f0f0f0; height: 50px; margin-top: 20px; text-align: center;"><p class="p-style">{{ $product->amount }}</p></td>
						</tr>
						<tr>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
							<td style="height: 1px;"></td>
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
						<td style="width: 12.5%; background-color: #07569E; color: #fff; height: 30px; padding-left: 7px; font-size : 11px; font-weight: bold;">Total due</td>
						<td style="width: .07%; background-color: #fff; height: 30px;"></td>
						<td style="width: 12.5%; background-color: #07569E; color: #fff; height: 30px; text-align: center; font-size : 11px; font-weight: bold;">$ 322.00</td>
					</tr>
				</table>

				<div class="row" style="margin-top: 60px;">
					<div class="col-12">
						<table>
							<tr>
									<td style="font-weight: bold; color: #323232; font-size: 13px; padding-left: 5px;">PAYMENT INFORMATION</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
						</table>
						<div class="" style="width: 100%; height: 1px; background: #17579F; margin: 10px 0px 10px 0px;">

						</div>

						<div class="payment-info-desc" style="padding-left: 5px;">
							<p class="p-style" style="font-size: 11px; margin-top : 0px !important;">Make all checks payable to: Devyn Earls, Inc. <br>
								You can pay online with an additional 3% convience fee on my website: https://www.devynearlsinc.com</p>
							<p class="p-style" style="font-size: 11px; padding-top: 10px; padding-bottom:10px;">If you have any questions concerning this invoice, contact me at devyn@dewebdesigns.com</p>
							<p class="p-style" style="font-size: 11px;">Thank you for your business.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
{{-- 
		<div class="row" style="position: absolute; bottom: 0 !important;">
			<div class="col-md-12">
				<table>
					<tr>
						<td style="text-align: left;"><a class="p-style" style="text-decoration: none;" href="http://www.devynearlsinc.com/">http://www.devynearlsinc.com/</a></td>
						<td style="text-align: right;"><p class="p-style">Page 1 of 1</p></td>
					</tr>
				</table>
			</div>
		</div> --}}
	</div>
</body>
</html>
