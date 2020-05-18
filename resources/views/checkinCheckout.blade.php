<!DOCTYPE html>
<html >
<head>
<title>checkinCheckout</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/assets/css/checkinCheckout.css">
</head>
<body>

    <form action="/checkin" method="post">
        @csrf
		<div>

            <button type="submit">Checkin</button>

		</div>
	</form>

	<form action="/checkout" method="post">
        @csrf
	    <div>

			<button type="submit">Checkout</button>
		</div>

	</form>

</body>
</html>
