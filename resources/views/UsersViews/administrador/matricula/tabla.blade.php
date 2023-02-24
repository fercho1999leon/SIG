@extends('layouts.master2')
<html>
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add CSV Excel Export Button in Yajra Laravel Datatable</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
     <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
     <script src="{{ secure_asset('vendor/datatables/buttons.server-side.js') }}"></script>
     </head>
     <body>
     <div class="container">
     <br />
     <h3 align="center">Add CSV Excel Export Button in Yajra Laravel Datatable</h3>
     <br /> <div class="table-responsive"> <div class="panel panel-default"> <div class="panel-heading">Sample Data</div> <div class="panel-body"> {!! $dataTable->table() !!} {!! $dataTable->scripts() !!} </div> </div> </div> <br /> <br /> </div> </body> </html>
