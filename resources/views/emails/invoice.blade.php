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

		.container{
			margin-right: auto;
			margin-left: auto;
			width: 100%;
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

		.margin-bottom-1{
			margin-bottom: 10px;
		}
		.margin-bottom-2{
			padding-bottom: 20px !important;
		}
	</style>
</head>
<body>
	<div class="container">

		<div class="row" style="padding-bottom: 20px !important;">
			<div class="col-12">
				<h2 class="uppercase  text-right" style="padding-bottom: 10px;"><b>Invoice</b></h2>
				<p class="header-p text-right"><span class="light-blue" style="margin-right: 12px;">Reference:</span> {{ $ref }}</p>
				<p class="header-p text-right"><span class="light-blue" style="margin-right: 18px;">Billing Date:</span> {{ $billing_date }}</p>
				<p class="header-p text-right"><span class="light-blue" style="margin-right: 34px;">Due Date:</span> {{ $due_date }}</p>
			</div>
		</div>
		<div class="row" style="padding-bottom: 20px !important;">
			<div class="col-6">
				<h3 class="light-blue">OUR INFORMATION</h3>
				<hr class="hr-with-margin">
				<h4>Devyn Earls, Inc.</h4>
				<p>4446-1A Hendricks Ave., Ste 224</p>
				<p>Jacksonville, FL 32207</p>
			</div>
			<div class="col-6 float-right">
				<div class="billing-info">
					<h3 class="light-blue">BILLING TO</h3>
					<hr class="hr-without-margin">
					<h4>{{ $customer->business_name }}</h4>
					<p>{{ $customer->address }}</p>
					<p>{{ $customer->city.','.$customer->state.','.$customer->zip }}</p>
				</div>
			</div>
		</div>

		<div class="row" style="padding-bottom: 20px !important;">
			<div class="col-12">
				<table>
						<tr style="height: 40px; border-bottom: 1px solid #17579F!important;">
							<td style="font-weight: bold; color: #4a4a80; font-size: 14px;">PRODUCT</td>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right" style="font-size: 14px;">Total</td>
						</tr>
						<tr>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
						</tr>
					@foreach($products as $product)
						<tr>
							<td style="width: 50%; background-color: #ececec; height: 50px; margin-top: 20px; margin-left: 10px; padding-left: 5px;">{{ $product->product_name }}</td>
							<td style="width: .1%; background-color: #fff; height: 50px; margin-top: 20px;"></td>
							<td style="width: 25%; background-color: #ececec; height: 50px; margin-top: 20px; text-align: center;">{{ $product->description }}</td>
							<td style="width: .1%; background-color: #fff; height: 50px; margin-top: 20px;"></td>
							<td style="width: 20%; background-color: #ececec; height: 50px; margin-top: 20px; text-align: center;">{{ $product->amount }}</td>
						</tr>
					@endforeach
					<tr>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
						</tr>
					<tr>
						<td style="width: 60%; height: 50px; margin-top: 20px;"></td>
						<td style="width: .1%; background-color: #fff; height: 50px; margin-top: 20px;"></td>
						<td style="width: 25%; background-color: #4a4a80; color: #fff; height: 50px; margin-top: 20px; text-align: center;">Total Due</td>
						<td style="width: .1%; background-color: #fff; height: 50px; margin-top: 20px;"></td>
						<td style="width: 10%; background-color: #4a4a80; color: #fff; height: 50px; margin-top: 20px; text-align: center; font-size: 14px;">${{ $products->sum('amount') }}</td>
					</tr>
					<tr>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
						</tr>
						<tr>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
							<td style="height: 5px;"></td>
						</tr>
				</table>


				<table>
					<tr style="height: 40px; border-bottom: 1px solid #17579F!important; ">
							<td style="font-weight: bold; color: #4a4a80; font-size: 14px;">PAYMENT INFORMATION</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td style="height: 15px;"></td>
							<td style="height: 15px;"></td>
							<td style="height: 15px;"></td>
						</tr>
					<tr>
							<td>Make all checks payable to: Devyn Earls, Inc <br>
								You can pay online with an additional 3% convience fee on my website: https://www.devynearlsinc.com	
							</td>
						</tr>
						<tr>
							<td style="height: 15px;"></td>
							<td style="height: 15px;"></td>
							<td style="height: 15px;"></td>
						</tr>
						<tr>
							<td>If you have any questions concerning this invoice, contact me at devyn@dewebdesigns.com</td>
						</tr>
						<tr>
							<td style="height: 15px;"></td>
							<td style="height: 15px;"></td>
							<td style="height: 15px;"></td>
						</tr>
						<tr>
							<td>Thank you for your business.</td>
						</tr>
						<tr>
							<td style="height: 15px;"></td>
							<td style="height: 15px;"></td>
							<td style="height: 15px;"></td>
						</tr>
				</table>



				
			</div>
		</div>
	</div>
</body>
</html>