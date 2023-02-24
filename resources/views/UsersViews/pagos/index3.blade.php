<!DOCTYPE html>
@php
$leads = json_decode($responseData, true);

if ($resourcePath!=null) {
  # code...
}
@endphp
<html>
<head>
  <title>Customise Fields</title>
  <meta charset="UTF-8">
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$leads['id']}}"></script>


  <style type="text/css">
    .my-custom-class {
      border: 1px dashed #f00 !important;
    }
  </style>

</head>
<body>
<form action="{{route('recibeToken')}}" method="POST" class="paymentWidgets" data-brands='VISA MASTER DINERS DISCOVER'>
</form>
</body>
</html>
<script type="text/javascript">

</script>

