<!DOCTYPE html>
<html>
<head>
  <title>Customise Fields</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdn.kushkipagos.com/kushki.min.js"></script>

  <style type="text/css">
    .my-custom-class {
      border: 1px dashed #f00 !important;
    }
    .expiration {
    border: 1px solid #bbbbbb;
}
.expiration input {
    border: 0;
}
  </style>

</head>
<body>
  <div class="container">
  <!-- Content here -->
  <div class="card">
  <div class="card-header">
    PAGO EN LINEA
  </div>
  <div class="card-body">
    <h5 class="card-title">Complete los siguientes datos</h5>
    <div class="modal-body">
      <form>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Nombre de la tarjeta">
    </div>
  </div>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Número de Tarjeta" id="nTarjeta" maxlength="19">
    </div>
  </div>
    <div class="row">
    <div class="col">
        <input type="text" class="form-control" placeholder="MM/AA" id="expiry" maxlength="5">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="CVC">
    </div>
  </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary">Pagar $34.00</a>
  </div>
</div>
</div>
</form>
<form id="included-cajita" action="" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="cart_id" id="cart_id" value="123">
    <input type="text" name="id_representante" value="12">
    <input type="text" name="valor" id="valor" value="150.00">
    <input type="text" name="bank" id="bank" value="">
    <input type="text" name="brand" id="brand" value="">
    <input type="text" name="cardType" id="cardType" value="">
</form>
</div>
<script type="text/javascript">
  
var characterCount
$('#expiry').on('input',function(e){
    if($(this).val().length == 2 && characterCount < $(this).val().length) {
        $(this).val($(this).val()+'/');
    }
    characterCount = $(this).val().length
});
var characterBinfo
$('#nTarjeta').on('input',function(e){
    if($(this).val().length == 7 && characterBinfo < $(this).val().length) {


    var someVariable = $('#nTarjeta').val()
    miTexto = someVariable.replace(' ','');
    kushki.requestBinInfo(
    {
    bin: miTexto
    },
    callbank);
    }
    if(($(this).val().length == 4 || $(this).val().length == 9 || $(this).val().length == 14) && characterBinfo < $(this).val().length) {
      $(this).val($(this).val()+' ');
    }
    characterBinfo = $(this).val().length
});

var callbank = function(response) {
  if(!response.code){
    console.log(response);
  } else {
    console.error('Error: ',response.error, 'Code: ', response.code, 'Message: ',response.message);
  }
}
      

  var kushki = new Kushki({
  merchantId: 'fc804215c7cf4fb4879e6009b18b4bab', 
  inTestEnvironment: true,
  regional:false
  });

var callback = function(response) {
  if(!response.code){
    console.log(response);
  } else {
    console.error('Error: ',response.error, 'Code: ', response.code, 'Message: ',response.message);
  }
}

kushki.requestToken({
  amount: '49.99',
  currency: "USD",
  months: 3, //for Chilean merchants only
  card: {
    name: "Juan Guerra",
    number: "4544980425511225",
    cvc: "345",
    expiryMonth: "12",
    expiryYear: "28"
},
},callback);  // Also you can set the function directly
</script>
</body>
</html>

