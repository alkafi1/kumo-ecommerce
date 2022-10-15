

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Kumo Invoice</title>

		<style>
			.clearfix:after {
				content: "";
				display: table;
				clear: both;
			}

			a {
			color: #5D6975;
			text-decoration: underline;
			}

			body {
			position: relative;
			width: 21cm;  
			height: 29.7cm; 
			margin: 0 auto; 
			color: #001028;
			background: #FFFFFF; 
			font-family: Arial, sans-serif; 
			font-size: 12px; 
			font-family: Arial;
			}

			header {
			padding: 10px 0;
			margin-bottom: 30px;
			}

			#logo {
			text-align: center;
			margin-bottom: 10px;
			}

			#logo img {
			width: 90px;
			}

			h1 {
			border-top: 1px solid  #5D6975;
			border-bottom: 1px solid  #5D6975;
			color: #5D6975;
			font-size: 2.4em;
			line-height: 1.4em;
			font-weight: normal;
			text-align: center;
			margin: 0 0 20px 0;
			background: url(dimension.png);
			}

			#project {
			float: left;
			}

			#project span {
			color: #5D6975;
			text-align: right;
			width: 52px;
			margin-right: 10px;
			display: inline-block;
			font-size: 0.8em;
			}

			#company {
			float: right;
			text-align: right;
			}

			#project div,
			#company div {
			white-space: nowrap;        
			}

			table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			margin-bottom: 20px;
			}

			table tr:nth-child(2n-1) td {
			background: #F5F5F5;
			}

			table th,
			table td {
			text-align: center;
			}

			table th {
			padding: 5px 20px;
			color: #5D6975;
			border-bottom: 1px solid #C1CED9;
			white-space: nowrap;        
			font-weight: normal;
			}

			table .service,
			table .desc {
			text-align: left;
			}

			table td {
			padding: 20px;
			text-align: right;
			}

			table td.service,
			table td.desc {
			vertical-align: top;
			}

			table td.unit,
			table td.qty,
			table td.total {
			font-size: 1.2em;
			}

			table td.grand {
			border-top: 1px solid #5D6975;;
			}

			#notices .notice {
			color: #5D6975;
			font-size: 1.2em;
			}

			footer {
			color: #5D6975;
			width: 100%;
			height: 30px;
			position: absolute;
			bottom: 0;
			border-top: 1px solid #C1CED9;
			padding: 8px 0;
			text-align: center;
			}
		</style>
	</head>

	<body>
    <header class="clearfix">
      <div id="logo">
        <img src='https://i.postimg.cc/xckVntgS/logo.png' border='0' alt='logo'/>
      </div>
      <h1>INVOICE </h1>
      <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>{{ $billing_info->first()->company }}</div>
        
        <div>Zip Code: {{ $billing_info->first()->zip_code }}</div>
      </div>
      <div id="project">
        <div><span>Name</span> {{ $billing_info->first()->name }}</div>
        <div><span>ADDRESS</span> {{ $billing_info->first()->address }}</div>
        <div><span>EMAIL</span>{{ $billing_info->first()->email }}</div>
        <div><span>MOBILE</span> {{ $billing_info->first()->mobile }}</div>
        <div><span>ORDER DATE </span>  {{ $billing_info->first()->created_at->format('d/m/y') }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">Item</th>
            <th class="desc">DESCRIPTION</th>
            <th class="desc">QTY</th>
            <th class="desc">PRICE</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
			@foreach ($order_products as $order_product )
				<tr>
					<td class="service">{{ $order_product->rel_to_product->product_title }}</td>
					<td class="desc">
						<span>Color: {{ $order_product->rel_to_color->color_name }}</span>
						<br>
						<span>Size: {{ $order_product->rel_to_size->size_name }}</span>
					</td>
					<td class="desc">{{ $order_product->quantity }}</td>
					<td class="desc">{{ $order_product->rel_to_product->after_discount }}</td>
					<td class="total">{{ $order_product->price }}</td>
				</tr>
			@endforeach
          
          <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">{{ $order->first()->sub_total }}</td>
          </tr>
          <tr>
            <td colspan="4">DISCOUNT </td>
            <td class="total">{{ $order->first()->discount }}</td>
          </tr>
          <tr>
            <td colspan="4">CHARGE</td>
            <td class="total">{{ $order->first()->charge }}</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">TOTAL</td>
            <td class="grand total">{{ $order->first()->total }}</td>
          </tr>
        </tbody>
      </table>
      
    </main>
    
  </body>
</html>





