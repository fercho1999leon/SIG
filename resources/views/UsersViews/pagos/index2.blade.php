<!DOCTYPE html>
<html>
<head>
  <title>Customise Fields</title>
  <meta charset="UTF-8">
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdn.kushkipagos.com/kushki-checkout.js"></script>
<script src="https://cdn.kushkipagos.com/kushki.min.js"></script>

  <style type="text/css">
    .my-custom-class {
      border: 1px dashed #f00 !important;
    }
  </style>

</head>
<body>
<form id="included-cajita" action="" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="cart_id" value="123">
    <input type="text" name="id_representante" value="12">
    <input type="text" name="valor" id="valor" value="150.00">
</form>
<script type="text/javascript">
    var kushki = new KushkiCheckout({
        form: "included-cajita",
        merchant_id: "fc804215c7cf4fb4879e6009b18b4bab",
        amount: $('#valor').val(),
        currency: "USD",
      	payment_methods:["credit-card"], // Payment Methods enabled
      	inTestEnvironment: true, 
      	regional:false // Optional
      	});
</script>
</body>
</html>

