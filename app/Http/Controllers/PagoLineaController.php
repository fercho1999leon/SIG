<?php

namespace App\Http\Controllers;
require_once "../kushki/autoload.php";
use App\PagoLinea;
use App\Student2Profile;
use App\Student2;
use App\Factura;
use App\PagoEstudianteDetalle;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use \Kushki\lib\Amount;
use \Kushki\lib\Kushki;
use \Kushki\lib\KushkiEnvironment;
use \Kushki\lib\Transaction;
use \Kushki\lib\ExtraTaxes;
use \Kushki\lib\KushkiLanguage;
use \Kushki\lib\KushkiCurrency;
use \Kushki\lib\KushkiRequest;
use Illuminate\Support\Facades\Validator;
use App\HistoricoTransaccionesEnLinea;
use Illuminate\Support\Facades\Redirect;
use App\Payment;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;





class PagoLineaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {//ver pagos
       $historico=HistoricoTransaccionesEnLinea::latest()
      ->where('status', '<>', 'ELIMINADO-POR-ADMIN')
      ->paginate(10);
         $view = \View::make('UsersViews.pagos.listar_historico')->with('historico',$historico);
        if($request->ajax()){

            $sections = $view->renderSections();
            return Response::json($sections['contentPanel']);
        }else {

           return View('UsersViews.pagos.index')->with('historico',$historico);
        }
}
public function ajaxPagination(Request $request)
    {
         $historico=HistoricoTransaccionesEnLinea::latest()
      ->where('status', '<>', 'ELIMINADO-POR-ADMIN')
      ->paginate(10);
        $view = \View::make('UsersViews.pagos.index')->with('historico',$historico);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['contentPanel']);
        }else return $view;
    }

    public function index2()
    {


/*
$url = "https://test.oppwa.com/v1/checkouts";
$data = "entityId=8a829418533cf31d01533d06f2ee06fa" .
                "&amount=5.00" .
                "&currency=USD" .
                "&paymentType=DB";
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                   'Authorization:Bearer OGE4Mjk0MTg1MzNjZjMxZDAxNTMzZDA2ZmQwNDA3NDh8WHQ3RjIyUUVOWA=='));
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $responseData = curl_exec($ch);
 if(curl_errno($ch)) {
  return curl_error($ch);
 }
 curl_close($ch);
 $resourcePath=null;
  return view('UsersViews.pagos.index3', compact('responseData','resourcePath'));


    /*
    $url  = "https://test.oppwa.com/v1/checkouts";
    $data = "entityId=8a829418533cf31d01533d06f2ee06fa" .
            "&amount=10.00" .
            "&currency=USD" .
            "&paymentType=DB";
           // alert($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Autorizacion:Bearer OGE4Mjk0MTg1MzNjZjMxZDAxNTMzZDA2ZmQwNDA3NDh8WHQ3RjIyUUVOWA==' ));
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);//cambiar en produccion a true
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if (curl_errno($ch)) {
      return curl_error($ch).'error';
    }
    curl_close($ch);
    return $responseData;

        return view('UsersViews.pagos.index');*/

$data = array('id' => '8ac7a4a071e57ed30171e65856561583', 'paymentType' => 'DB', 'paymentBrand' => 'VISA', 'amount' => '4.25', 'currency' => 'USD', 'descriptor' => '1808.3830.9023 PINED', 'merchantTransactionId' => 'transaction_612', 'result' => array('code' => '000.100.112', 'description' => 'Request successfully processed in \'Merchant in Connector Test Mode\''), 'resultDetails' => array('RequestId' => '350551098505', 'RiskFraudStatusCode' => 'ACCEPT', 'AuthCode' => '050478', 'ConnectorTxID1' => '8ac7a4a071e57ed30171e65856561583', 'ReferenceNbr' => '200505_003427', 'EXTERNAL_SYSTEM_LINK' => 'https://csi-stage.redworldwide.com/index.red#transactiondetail/000537210251XFK20200505153801750', 'OrderId' => '180838309023', 'RiskStatusCode' => 'PENDING', 'ExtendedDescription' => 'Transaction succeeded', 'clearingInstituteName' => 'Datafast', 'RiskResponseCode' => '0100', 'action' => 'created', 'AcquirerResponse' => '00_04VG', 'RiskOrderId' => '000537210251XFK20200505153801750'), 'card' => array('bin' => '454063', 'binCountry' => 'EC', 'last4Digits' => '0000', 'holder' => 'Juan Ruiz', 'expiryMonth' => '04', 'expiryYear' => '2022'), 'customer' => array('givenName' => 'ADRIANA', 'surname' => 'ALAVA JARAMILLO', 'middleName' => 'PAOLA', 'phone' => '0996757008', 'email' => 'adrianaalava_22@hotmail.com', 'identificationDocType' => 'IDCARD', 'identificationDocId' => '092157305', 'ip' => '127.0.0.1', 'browserFingerprint' => array('value' => '0400CIfeAe15Cx8Nf94lis1ztjCRlWClzW5X/QmmIKQnhN1CSCuC8uFJABqYmKR8Sw+qdik+BCIRXKIWEAN94ZBk7bwVtSus7k3pP8qFSAZ42op95eoW86m0k48spXWvLb/6yhm25ErBx/EAa6ubB0Kmo4dMpSRnzNZuXUg7xbEPUqGVQl0zFcQukIK4mjKAMqULsj69LfM7VRYrI1FeHSbDspvXHhwykQoiuMSNUUyGAvKLg+9aginJmamvnOVDH3SzV6i8/tb5alAK/XRNo3H5dMIK6EAX6crimL3qGkuc+b70MRB4yq+oTlU8NguKENqeSipYNscDiy7T7W+bd9sPivsXifniv6oDybgjBFgdHlO9E9x7uNyVNntp96CNvJJFsO0T8ZlTNchAh9WdodAszvPfBp8j9Zgcw5pdgU3eFSv00k7SJpWhYtOCPPlJnrU205+m/s9uEinvsD8Ae2HMhAjTuni0YYcF7yZHbT+hap+GncZZm+V9P8Cq9DH/qIFm6XNHeKh/DF8EouyscoUrlWkAsPHEHl2G1PXpN4zl2IQd/tZS2Kh2RDNVsy10v3ATeurH4BGZEiLEqYqLQTmZss3X8S8pWAYm7BFQVjvF0CKqWvTbz/c+r5M6n5DS7v8TTf6BueefmqI57RHFZltZDFd6oX/FlTt1kp62yUjciLG5AbNT6fcIC6Bx0NdEKXmvrI3MaSYrgzshIqKrjK+gdyAFUwN05hXzcycRhS8EwApMRV0YmXEHAJzxpxtwqoC5Z/uCi7ME8loQwLLSzeFEuVfe4edP+YyrMScNWPrm3gnCFpWdnTcBbUV2hD3GTm47oOXUWxljyPAVpcqq3kfmP7OgSQ0Fzflca1WxiZ1a0z3VhghPLNHC/w9dek5r8WH9DtPq/jlyS0tKn4II0n46KK6xraOOHRWfd6dlY8UTIEiJKSIdwO9O5Z/8KrD4hgXHxKZFk5ZzIuZJsxD5GvQXD7trb8rBJJ6K6HwR0cGhkeYRu68C9BGsJBJq22freHJrSDrvPC9gbeF/87O3oWRCb1Fj5+/aIwlN1wqSDIYbB8J6hxshzDbJFwpcz6ROhEILelSB5/QSJG4MlbI6Cnd06Vwd052dsnV9SSVBtWU48Cu65gFRFy2Lowyk4VT9YQMg7GGaBORuy8odEfb0TY+Xry83Rel4W1HH9yN1uAfESRGaCRGrVCzjyxtf1ALyc5MPSe1voVwnIQ4Q5XOYm0OqKaTMOr5JdHX/uiPR/pi0lzRVJUiLP0GDKv8DVKzg5EsSZxZFyDjmjm5CZURyFnXNpqQQ5gipW4NPpubr+0JWufAlTASJDhgwSkOXN5MTjIs7iuv6Xcf4KsL7F4n54r+qA8m4IwRYHR5TvRPce7jclTZ7afegjbySRbDtE/GZUzXIS9+SH/DOztg=')), 'billing' => array('street1' => 'GUAYACANES MZ 220 VILLA 21', 'country' => 'EC'), 'customParameters' => array('SHOPPER_EndToEndIdentity' => 'fe1133deffc17433bb889d290babf104dbddc1c45c044f233d6691ff965a439e', 'CTPE_DESCRIPTOR_TEMPLATE' => '', '1000000505_PD100406' => '0081003007010391000401200000000000005100817913101052012000000000425053012000000000100'), 'risk' => array('score' => '0', 'parameters' => array('USER_DATA2' => 'PINED')), 'cart' => array('items' => array(array('name' => 'Carnet estudiantil', 'description' => 'Descripción: CARNET__2', 'quantity' => '1', 'price' => '4.25'))), 'buildNumber' => 'd7c2a53c277f4415ae502cbf6e29b5c49eb022a4@2020-05-05 09:12:26 +0000', 'timestamp' => '2020-05-05 19:38:03+0000', 'ndc' => '75D755362FA43152929ED5032C451FDD.uat01-vm-tx03');
//return $data;


//return 'id_transacción; '.$data['id'].' monto; '.$data['amount'].' codigo_resul: '.$data['result']['code'].' descripcion: '.$data['result']['description'].' AuthCode: '.$data['resultDetails']['AuthCode'].' ReferenceNbr: '.$data['resultDetails']['ReferenceNbr'].' AcquirerResponse: '.$data['resultDetails']['AcquirerResponse'].' customParameters: '.$data['customParameters']['1000000505_PD100406'];

    //separo el id del cliente y del estudiante;
if (isset( $data['customer']['merchantCustomerId']) ) {
     list($cliente_id,$estudiante_id) = explode("__", $data['customer']['merchantCustomerId']);
     return $cliente_id;
    }
    return $data;
}




/*
 if ($data['result']['code'] =='000.000.000' || $data['result']['code'] =='000.100.112' || $data['result']['code'] =='000.100.110') {


                $historicoPEL = new HistoricoTransaccionesEnLinea();
                 $historicoPEL->transaccion          =$data['id'];
        $historicoPEL->codigo_error         =$data['result']['code'];
        $historicoPEL->descripcion_error    =$data['result']['description'];
        $historicoPEL->total                =$data['amount'];
        $historicoPEL->idCliente            =$cliente_id;
        $historicoPEL->AuthCode_DF          =$data['resultDetails']['AuthCode'];
        $historicoPEL->ReferenceNbr_DF      =$data['resultDetails']['ReferenceNbr'];
        $historicoPEL->ArquirerResponse_DF  =$data['resultDetails']['AcquirerResponse'];
        $historicoPEL->customParameters_DF  =$data['customParameters']['1000000505_PD100406'];
        $historicoPEL->shopper_interes_DF  =$data['customParameters']['SHOPPER_interes'];
        $historicoPEL->status  ='COMPLETADA';
                $idTransaccion=$historicoPEL->id;

//hasta aqui funcionando bien !!!!!!!


                }else{
                $historicoPEL = new HistoricoTransaccionesEnLinea();
                $historicoPEL->transaccion          =$data['id'];
                $historicoPEL->codigo_error         =$data['result']['code'];
                $historicoPEL->descripcion_error    =$data['result']['description'];
                $historicoPEL->total                =$data['amount'];
                $historicoPEL->idCliente            =$cliente_id;
                $historicoPEL->ReferenceNbr_DF         =$data['resultDetails']['ReferenceNbr'];
                $historicoPEL->ArquirerResponse_DF  =$data['resultDetails']['AcquirerResponse'];
                $historicoPEL->customParameters_DF  =$data['customParameters']['1000000505_PD100406'];
                $historicoPEL->save();

                //regresar al modulo de la factura mostrando el error !!

                }



}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PagoLinea  $pagoLinea
     * @return \Illuminate\Http\Response
     */
    public function show(PagoLinea $pagoLinea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PagoLinea  $pagoLinea
     * @return \Illuminate\Http\Response
     */
    public function edit(PagoLinea $pagoLinea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PagoLinea  $pagoLinea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PagoLinea $pagoLinea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PagoLinea  $pagoLinea
     * @return \Illuminate\Http\Response
     */
    public function destroy(PagoLinea $pagoLinea)
    {
        //
    }
    public function pagoTarjeta(Request $request)
    {
        return 'en pago';
    }
    public function recibe_token(Request $request)
    {

    $entityId='8a829418533cf31d01533d06f2ee06fa';
    $resourcePath = $request->resourcePath;
       $url = "https://test.oppwa.com".$resourcePath;
        $url .= "?entityId=".$entityId;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization:Bearer OGE4Mjk0MTg1MzNjZjMxZDAxNTMzZDA2ZmQwNDA3NDh8WHQ3RjIyUUVOWA=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
        return curl_error($ch);
        }
        curl_close($ch);
        $leads = json_decode($responseData, true);

   return view('UsersViews.pagos.respuesta.index', compact('resourcePath'));

    }
     public function mostrar_boton(Request $request)
    {


            $url = "https://test.oppwa.com/v1/checkouts";
            $data = "entityId=8a829418533cf31d01533d06f2ee06fa" .
            "&amount=5.00" .
            "&currency=USD" .
            "&paymentType=DB";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTg1MzNjZjMxZDAxNTMzZDA2ZmQwNDA3NDh8WHQ3RjIyUUVOWA=='));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
            return curl_error($ch);
            }
            curl_close($ch);

            $leads = json_decode($responseData, true);
                $output ='<HTML>';
                $output .='<HEAD>';
            $output .= ' <script type="text/javascript" src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='.$leads['id'].'"></script>';
            $output .='</HEAD>';
            $output .='<BODY>';
            $output .='<form action="" method="POST" class="paymentWidgets" data-brands="VISA MASTER DINERS DISCOVER">        </form>';
            $output .='</BODY>';
            $output .='</HTML>';

        echo $output;
    }
    public function anular($id_factura,$id_estudiante)
    {
      $student = Student2::findOrFail($id_estudiante);
      $factura = Factura::findOrFail($id_factura);
      $historico = HistoricoTransaccionesEnLinea::findOrFail($factura->idTransaccion);
      return view('UsersViews.pagos.anular', compact('id_factura','student','historico'));
        //
    }public function eliminarTarjetas($id_cliente)
    {
      $historico = HistoricoTransaccionesEnLinea::where('idCliente',$id_cliente)->get();
      foreach ($historico as $hist) {
      $hist->registrationId=null;
      $hist->save();
      }


    }
      public function eliminar(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'nTarjeta' => 'required|string|min:19|max:20',
        'expiry' => 'required|string|min:5|max:6',
        'id_historico' => 'required',
      ], ['nTarjeta.required' => 'Falta el numero de la tarjeta.',
        'expiry.required' => 'Falta fecha de vencimiento de la tarjeta.',
        'id_historico.required' => 'Error comuniquese con el administrador']);
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput($request->all());
      }
    $tajeta=str_replace(' ', '', $request->nTarjeta);
    list($mm,$aa) = explode('/', $request->expiry);
    $merchterm='1000000505_PD100406';
    $historico = HistoricoTransaccionesEnLinea::findOrFail($request->id_historico);
    list($nullo,$referencia) = explode('_', $historico->ReferenceNbr_DF);
    $url = "https://test.oppwa.com/v1/payments/".$historico->transaccion;
    $data = "authentication.entityId=8ac7a4c971df15330171e05eb0810592" .
          "&paymentType=RF".
          "&amount=".$historico->total .
          "&currency=USD" .
          "&customParameters[AUTOCODE]="   .$historico->AuthCode_DF.
          "&customParameters[PAN]="        .$tajeta.
          "&customParameters[STAN]="       .$referencia.
          "&customParameters[expiryMonth]=".$mm.
          "&customParameters[expiryYear]=" .$aa.
          "&customParameters[".$merchterm."]=".$historico->customParameters_DF.
          "&customParameters[shopper_interes]=" .$historico->shopper_interes_DF.
          "&customParameters[shopper_gracia]=" .$historico->shopper_gacia_DF.
          "&customParameters[shopper_installments]=".$historico->numero_diferido_DF.
          "&testMode=EXTERNAL";

          return $data;

           $ch = curl_init();
            curl_setopt($ch, CURLOPT_TIMEOUT, 50);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA=='));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);

            $data = json_decode($responseData, true);
            list($nulo,$factura_transaccion) = explode("__", $data['merchantTransactionId']);
            list($cliente_id,$estudiante_id) = explode("__", $data['customer']['merchantCustomerId']);
            if(curl_errno($ch)) {

              return redirect()->route('representantePagosPendientes', ['id' => $request->id_estudiante])->with('message', ['error' => 'danger', 'text' => 'No se pudo anular, comuniquese con el administrador ']);

            }
            curl_close($ch);
            if ($data['result']['code'] =='000.000.000' || $data['result']['code'] =='000.100.112' || $data['result']['code'] =='000.100.110')  {

                $historico->codigo_error=$data['result']['code'];
                $historico->descripcion_error=$data['result']['description'];
                $historico->status='ANULADO-POR-CLIENTE';
                $historico->save();
                $historicoPEL = new HistoricoTransaccionesEnLinea();
                $historicoPEL->transaccion              =$data['id'];
                $historicoPEL->paymentype_DF            =$data['paymentType'];
                $historicoPEL->codigo_error             =$data['result']['code'];
                $historicoPEL->descripcion_error        =$data['result']['description'];
                $historicoPEL->total                    =$data['amount'];
                $historicoPEL->idCliente                =$cliente_id;
                $historicoPEL->AuthCode_DF              =$data['customParameters']['AUTOCODE'];
                $historicoPEL->MerchantTransactionId_DF =$factura_transaccion;
                $historicoPEL->ReferenceNbr_DF          =$data['resultDetails']['ReferenceNbr'];
                $historicoPEL->ArquirerResponse_DF      =$data['resultDetails']['AcquirerResponse'];
                $historicoPEL->customParameters_DF      =$data['customParameters']['1000000505_PD100406'];
                $historicoPEL->status  ='COMPLETADA-ANULADA';
                if (isset($data['customParameters']['SHOPPER_interes']) ) {
                $historicoPEL->shopper_interes_DF =$data['customParameters']['SHOPPER_interes'];
                }
                if (isset($data['customParameters']['SHOPPER_gracia']) ) {
                $historicoPEL->shopper_gacia_DF =$data['customParameters']['SHOPPER_gracia'];
                }
                if (isset( $data['recurring']['numberOfInstallments']) ) {
                $historicoPEL->numero_diferido_DF   =$data['recurring']['numberOfInstallments'];
                }
                $historicoPEL->save();
                return $data;
                return redirect()->route('representantePagosPendientes', ['id' => $request->id_estudiante])->with('message', ['type' => 'success', 'text' => 'El pago se anulo correctamente']);
              }else{
                 if (isset( $data['result']['code']) ) {

              return redirect()->route('representantePagosPendientes', ['id' => $request->id_estudiante])->with('message', ['error' => 'danger', 'text' => 'No se pudo anular. codigo: '.$data['result']['code'].' descipcion: '.$data['result']['description']]);

            }

              }
               return redirect()->route('representantePagosPendientes', ['id' => $request->id_estudiante]);

            }public function ver_pago($id_cliente)
            {

              $historico = HistoricoTransaccionesEnLinea::findOrFail($id_cliente);
           // return 'describiendo pago'.$id_cliente;
          $url = "https://test.oppwa.com/v1/query/".$historico->transaccion;
          $url .= "?authentication.entityId=8ac7a4c971df15330171e05eb0810592";


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             'Authorization:Bearer OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA=='));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            $data = json_decode($responseData, true);
            if(curl_errno($ch)) {

            }
            curl_close($ch);

            $html='<ul>';
            $html.='<li>TIPO DE TARJETA: '.$data['paymentBrand'].'</li>';
            $html.='<li>MONTO: '.$data['amount'].'</li>';
            $html.='<li>ID TRANSACCIÓN: '.$data['id'].'</li>';
            $html.='<li>FACTURA: '.$data['merchantTransactionId'].'</li></ul>';
            return $html;
            }public function eliminar_transaccion($id_cliente)
            {
              $historico = HistoricoTransaccionesEnLinea::findOrFail($id_cliente);
              $historico->status='ELIMINADO-POR-ADMIN';
              $historico->save();
             }
              public function search(){//busqueda desde la vista


                 if ($search = \Request::get('q')) {
                $historico=HistoricoTransaccionesEnLinea::where(function($query) use ($search){
                $query->where('status','LIKE',"%$search%")
                        ->orWhere('total','LIKE',"%$search%")
                        ->orWhere('codigo_error','LIKE',"%$search%")
                        ->orWhere('idCliente','LIKE',"%$search%")
                        ->orWhere('created_at','LIKE',"%$search%");
                        })->where('status', '<>', 'ELIMINADO-POR-ADMIN')
                ->orderBy('id', 'DESC')
                ->paginate();
                 $view = \View::make('UsersViews.pagos.listar_historico')->with('historico',$historico);
                $sections = $view->renderSections();
            return Response::json($sections['contentPanel']);
            }else{
                    $historico=HistoricoTransaccionesEnLinea::latest()
                    ->where('status', '<>', 'ELIMINADO-POR-ADMIN')
                    ->paginate(10);
                    $view = \View::make('UsersViews.pagos.listar_historico')->with('historico',$historico);
                    $sections = $view->renderSections();
                    return Response::json($sections['contentPanel']);

              }
              }
}
