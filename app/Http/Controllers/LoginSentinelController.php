<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use App\Administrative;
use App\Student2;
use App\Course;
use App\MessageDetail;
use App\Institution;
use App\ConfiguracionSistema;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BibliotecaReportController;

class LoginSentinelController extends Controller
{
  public function login(){
		$institution = Institution::first();
    return view('authentication.login', compact(
      'institution'
    ));
  }

  public function postLogin(Request $request){
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required',
    ]);
    try {
     //dd(Hash::make('12345')); 
      $user = Sentinel::authenticate($request->all());
      if($user){
        session()->put('rol',Sentinel::getUser()->roles()->first());
        return redirect('perfil');
      }
      return Redirect::back()->withErrors(['login_fail' => 'Usuario y/o Contraseña no válidos.']);
    } catch (Exception $e) {
      return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
    }
	}

  public function logout(Request $request){
    //dd(session('horaInicio'), session('user') );
    
    if(session('horaInicio') != null && session('user') != null){
      $sessionHora = new BibliotecaReportController;
      $sessionHora->sessionHora();
    }
    

    Sentinel::logout();
    $request->session()->flush();
    return redirect('/');
  }
  public function logoutAdmisiones(Request $request){
    if(session('horaInicio') != null && session('user') != null){
      $sessionHora = new BibliotecaReportController;
      $sessionHora->sessionHora();
    }
    //dd($request);
    Sentinel::logout();
    $request->session()->flush();
    return Redirect::route('admision_datos',['cedula' => $request->search]);
  }

  public function home(){
    try {
      //dd(session('horaInicio'));
      if(session('horaInicio') != null && session('user') != null){
        $sessionHora = new BibliotecaReportController;
        $sessionHora->sessionHora();
       // dd($sessionHora);
      }
      

      $user = Sentinel::getUser();
      $user_profile = Administrative::findBySentinelid($user->id);
      $editarDatosEstudiante = ConfiguracionSistema::editarDatosEstudiante();
      $courses = Course::getAllCourses();
      session()->put('user_data',$user_profile);
      session()->put('user_role',$user->roles()->get());
      $hijos = Student2::where('idRepresentante',$user_profile->id)->get();
      session()->put('hijos_data',$hijos);
      if($user_profile->cargo == "Estudiante"){
        $estudiante = Student2::where('idProfile',$user_profile->id)->first();
        session()->put('estudiante',$estudiante);
      }
      if($user_profile) return view($user_profile->rolPivot->rol->slug.'.perfil', compact('courses', 'user_profile','editarDatosEstudiante'));
    }catch (Exception $e){
      logout();
      return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
    }
  }

  public function edit(){
    try {
      $courses = Course::getAllCourses();
      $user = Sentinel::getUser();
      $user_profile = Administrative::findBySentinelid($user->id);
      session()->put('user_data',$user_profile);
      if($user_profile)
        return view(session('rol')->slug.'.editPerfil', compact('courses'));
    } catch (Exception $e) {
      logout();
      return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
    }
  }

  public function updateUserGeneralData(Request $request){
    try {
      $this->validate($request,[
        'email'  =>  'required|email',
        'password'  =>  'string|min:3|max:20|nullable',
      ]);
      $user = Sentinel::getUser();
      $user_profile = Administrative::findBySentinelid($user->id);
      $user_Sentinel = Sentinel::findById($user_profile->userid);
      $students2 = Student2::where('idProfile',$user_profile->id)->first();
      session()->put('user_data',$user_profile);
      if($user_profile){
        $user_profile->nombres=$request->nombres;
        $user_profile->apellidos=$request->apellidos;
        $user_profile->ci=$request->ci;
        if(isset($request->password)){
          $credentials['email'] = $request->email;
          $credentials['password'] = $request->password;
          Sentinel::update($user_Sentinel, $credentials);
        }
        if($user_profile->correo != $request->email){
          $user_profile->correo = $request->email;
          $user_Sentinel->email = $request->email;
        }
        $user_profile->movil=$request->movil;
        $user_profile->dDomicilio=$request->dDomicilio;
        $user_profile->tDomicilio=$request->tDomicilio;
        $user_profile->numero_emergencia=$request->numero_emergencia;
        $user_profile->enfermedad=$request->enfermedad;
        $user_profile->observacion=$request->observacion;
        $user_profile->grupo_sanguineo=$request->grupo_sanguineo;
        $user_profile->save();
        $user_Sentinel->save();
      } // actualizo la tabla students2
      if ($students2!=null) {
        $students2->ci                   =  $request->ci;
        $students2->nombres              =  $request->nombres;
        $students2->apellidos            =  $request->apellidos;
        $students2->telefono             =  $request->movil;
        $students2->direccion            =  $request->dDomicilio;
        $students2->telefonoEmergencia   =  $request->numero_emergencia;
        $students2->tipoVivienda         =  $request->grupo_sanguineo;
        $students2->save();
      }


      return redirect()->route('home');
    }catch (Exception $e){
      logout();
      return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
    }
  }

  public function updateUserDomicilioData(Request $request){
    try {
      $user = Sentinel::getUser();
      $user_profile = Administrative::findBySentinelid($user->id);
      session()->put('user_data',$user_profile);
      if($user_profile){
        $user_profile->dDomicilio = $request->dDomicilio;
        $user_profile->tDomicilio = $request->tDomicilio;
        $user_profile->save();
        return redirect('perfilEdit');
      }
    }catch (Exception $e){
      logout();
      return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
    }
  }

  public function updateUserEmergencyTelf(Request $request){
    try {
      $user = Sentinel::getUser();
      $user_profile = Administrative::findBySentinelid($user->id);
      session()->put('user_data',$user_profile);
      if($user_profile){
        $user_profile->enfermedad = $request->enfermedad;
        $user_profile->observacion = $request->observacion;
        $user_profile->numero_emergencia = $request->numero_emergencia;
        $user_profile->grupo_sanguineo = $request->grupo_sanguineo;
        $user_profile->save();
        return redirect('perfilEdit');
      }
    }catch (Exception $e){
      logout();
      return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
    }
  }
}
