<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class AutocompleteController extends Controller
{
     public function index()
    {
     return view('autocomplete');
    }

 public function fetch(Request $request)
    {
      //return $request;
     if($request->get('query'))
     {
      $query = $request->get('query');


       $data = DB::table('users_profile')
            ->where('cargo', '=', 'Representante')
            ->where(function ($consulta)use ($query) {
            $consulta->where('nombres', 'LIKE', "%{$query}%")
            ->orWhere('apellidos','LIKE', "%{$query}%")
            ->orWhere('ci','LIKE', "%{$query}%");
            })
            ->paginate(10);
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '

       <li class="repre" id="'.$row->id.'"><a href="#">'.$row->apellidos." ".$row->nombres."-".$row->ci.'</a>
       </li>
       ';
      }
      $output .= '</ul>';
      echo $output;
      
     }
    }
   public function fetchFinanciero(Request $request)
    {
      //return $request;
     if($request->get('query'))
     {$query = $request->get('query');
      $data = DB::table('clientes')
        ->where('nombres', 'LIKE', "%{$query}%")
        ->orWhere('apellidos','LIKE', "%{$query}%")
        ->orWhere('cedula_ruc','LIKE', "%{$query}%")
        ->paginate(10);
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '

       <li class="finan" id="'.$row->id.'"><a href="#">'.$row->apellidos." ".$row->nombres."-".$row->cedula_ruc.'</a>
       </li>
       ';
      }
      $output .= '</ul>';
      echo $output;
      
     }
    }
    public function fetchPadre(Request $request)
    {
      //return $request;
     if($request->get('query'))
     {$query = $request->get('query');

    $data = DB::table('datospadres')
            ->where('parentezco', '=', 'Padre')
            ->where(function ($consulta)use ($query) {
            $consulta->where('nombres', 'LIKE', "%{$query}%")
            ->orWhere('apellidos','LIKE', "%{$query}%")
            ->orWhere('ci','LIKE', "%{$query}%");
            })
            ->paginate(10);
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '

       <li class="padre" id="'.$row->id.'"><a href="#">'.$row->apellidos." ".$row->nombres."-".$row->ci.'</a>
       </li>
       ';
      }
      $output .= '</ul>';
      echo $output;
      
     }
    }
    public function fetchMadre(Request $request)
    {
      //return $request;
     if($request->get('query'))
     {$query = $request->get('query');
      $data = DB::table('datospadres')
            ->where('parentezco', '=', 'Madre')
            ->where(function ($consulta)use ($query) {
            $consulta->where('nombres', 'LIKE', "%{$query}%")
            ->orWhere('apellidos','LIKE', "%{$query}%")
            ->orWhere('ci','LIKE', "%{$query}%");
            })
            ->paginate(10);
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '

       <li class="madre" id="'.$row->id.'"><a href="#">'.$row->apellidos." ".$row->nombres."-".$row->ci.'</a>
       </li>
       ';
      }
      $output .= '</ul>';
      echo $output;
      
     }
    }
    public function email(Request $request)
    {
      //return $request;
     if($request->get('query'))
     {$query = $request->get('query');
      $data = DB::table('users_profile')
        ->where('nombres', 'LIKE', "%{$query}%")
        ->orWhere('apellidos','LIKE', "%{$query}%")
        ->orWhere('cargo','LIKE', "%{$query}%")
        ->orWhere('ci','LIKE', "%{$query}%")
        ->orWhere('correo','LIKE', "%{$query}%")
        ->orderByRaw("cargo")
        ->paginate(15);
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '<li class="finan" id="'.$row->id.'">';
       $output .="<a href='#' onClick=\"agregarEmail('".$row->id."','".$row->correo."','".$row->nombres."','".$row->apellidos."');\">"; 
       $output .=$row->apellidos." ".$row->nombres." - ".$row->correo." - ".$row->cargo.'</a></li>';
      }
      $output .= '</ul>';
      echo $output;
      
     }
    }
}
 