<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use App\Administrative;
use App\ConfiguracionSistema;
use App\Course;
use App\MessageDetail;
use App\Message;
use App\MessagesHilo;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Usuario;
use App\Student2Profile;
use App\Student2;
use Illuminate\Support\Str;
use App\Http\Controllers\BibliotecaReportController;
use Storage;
class NotificationController extends Controller
{
    public function home(){
		try {
			if(session('horaInicio') != null && session('user') != null){
				$sessionHora = new BibliotecaReportController;
				$sessionHora->sessionHora();
			  }
			$courses = Course::getAllCourses();
			$route = 'eliminarNotificacionesRecibidos';
			$user = Sentinel::getUser();
			$user_profile = Usuario::find($user->id)->profile->profileStudent;

			if ($user_profile == null) {
				$user = Sentinel::getUser();
				$user_profile = Administrative::findBySentinelid($user->id);
			} 
            session()->put('user_data',$user_profile);
            $bandeja = 'entrada';
            if($user_profile){
                
                $m = DB::table('messages_detail')
                    ->select('messages.*','messages_detail.visto','users_profile.nombres','users_profile.apellidos','users_profile.cargo')
                    ->join('messages', 'messages_detail.message_id', '=','messages.id')
					->join('users_profile', 'messages_detail.id_from', '=', 'users_profile.id')
					->orderBy('created_at', 'DESC')
					->where('messages_detail.eliminado', 0)
					->where('messages_detail.id_to',  $user_profile->id)
					->where('messages_detail.idPeriodo', $this->idPeriodoUser())
                    ->distinct()->get();
                $users = [];
                foreach ($m as $s) {
                    $users[$s->id] = DB::table('messages_detail')
                        ->join('users_profile', 'messages_detail.id_to', '=', 'users_profile.id')
                        ->where('messages_detail.message_id', $s->id)
                        ->get();
                }
                $cs = MessageDetail::getMessagesBySender($user_profile->id);
                $i = 0;
                foreach ($cs as $c) {
                    if ($c->message->eliminado == 0) 
                        $i++;
                }
                $cs = $i;
                $cm = MessageDetail::getMessagesByReciever($user_profile->id)->count();
                return view(session('rol')->slug.'.notificaciones.index', 
				['courses' => $courses, 'messages' => $m, 'countSend' => $cs, 'countMessages' => $cm,
				'route' => $route, 'users' => $users, 'bandeja' => $bandeja ]); 
            }                
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }

    public function recibidos(){
		try {
			$route = 'eliminarNotificacionesRecibidos';
			$courses = Course::getAllCourses();
	        $user = Sentinel::getUser();
			$user_profile = Usuario::find($user->id)->profile->profileStudent;
            $bandeja = 'entrada';
			if ($user_profile == null) {
				$user = Sentinel::getUser();
				$user_profile = Administrative::findBySentinelid($user->id);
	
			} 
	        session()->put('user_data',$user_profile);
	        //return session('user_data');
            if($user_profile){

				$cs = MessageDetail::getMessagesBySender($user_profile->id);
				$i = 0;
				foreach ($cs as $c) {
					if ($c->message->eliminado == 0) 
						$i++;
				}
				$cs = $i;
				$cm = MessageDetail::getMessagesByReciever($user_profile->id)->count();

                $m = DB::table('messages_detail')
                    ->select('messages.*','messages_detail.visto','users_profile.nombres','users_profile.apellidos','users_profile.cargo')
                    ->join('messages', 'messages_detail.message_id', '=','messages.id')
					->join('users_profile', 'messages_detail.id_from', '=', 'users_profile.id') 
					->orderBy('created_at', 'des')
					->where('messages_detail.id_to',  $user_profile->id)
					->where('messages_detail.eliminado', 0)
					->where('messages_detail.idPeriodo', $this->idPeriodoUser())
                    ->distinct()->get(); 
                $users = [];
                foreach ($m as $s) {
                    $users[$s->id] = DB::table('messages_detail')
                        ->join('users_profile', 'messages_detail.id_to', '=', 'users_profile.id')
                        ->where('messages_detail.message_id', $s->id)
                        ->get();
                }
                return view(session('rol')->slug.'.notificaciones.index', 
				['courses' => $courses, 'messages' => $m, 'countSend' => $cs, 'countMessages' => $cm,
				'route' => $route, 'users' => $users, 'bandeja' => $bandeja ]); 
            }                
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }


    public function enviados(){
        $courses = Course::getAllCourses();
    	try {
			$route = 'eliminarNotificacionesEnviados';
	        $user = Sentinel::getUser();
			$user_profile = Usuario::find($user->id)->profile->profileStudent;

			if ($user_profile == null) {
				$user = Sentinel::getUser();
				$user_profile = Administrative::findBySentinelid($user->id);
            }
            
            $bandeja = 'salida';
            session()->put('user_data',$user_profile);
            if($user_profile) {

                $cs = MessageDetail::getMessagesBySender($user_profile->id);
				$i = 0;
				foreach ($cs as $c) {
					if ($c->message->eliminado == 0) 
						$i++;
				}
				$cs = $i;
				$cm = MessageDetail::getMessagesByReciever($user_profile->id)->count();
				$s = DB::table('messages_detail')
                    ->join('messages', 'messages_detail.message_id', '=','messages.id')
                    ->join('users_profile', function($join) use($user_profile) {
                                $join->on('messages_detail.id_from', '=', 'users_profile.id')
                                    ->where('users_profile.id', '=', $user_profile->id);
                    })
                    ->orderBy('messages.created_at', 'DESC')
                    ->select('messages.*','users_profile.nombres','users_profile.apellidos','users_profile.cargo')
                    ->where('messages.eliminado', 0)
                    ->where('messages_detail.idPeriodo', $this->idPeriodoUser())
                    ->distinct()->get();
                $users = [];
                foreach ($s as $m) {
                    $users[$m->id] = DB::table('messages_detail')
                        ->join('users_profile', 'messages_detail.id_to', '=', 'users_profile.id')
                        ->where('messages_detail.message_id', $m->id)
                        ->get();
                }

                return view(session('rol')->slug.'.notificaciones.index', 
                ['courses' => $courses, 'messages' => $s, 'countSend' => $cs, 'countMessages' => $cm, 'route' => $route, 'users' => $users,
                'bandeja' => $bandeja ]); 
            }                
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }


    public function show($id){

        try{

			$user = Sentinel::getUser();
			$user_profile = Usuario::find($user->id)->profile->profileStudent;

			if ($user_profile == null) {
				$user = Sentinel::getUser();
				$user_profile = Administrative::findBySentinelid($user->id);
			} 

            $detail = MessageDetail::where(['message_id' => $id, 'id_to' => $user_profile->id])->first();
            if($detail != null){
                $detail->visto = true;
                $detail->save();    
            }
			
            $cs = MessageDetail::getMessagesBySender($user_profile->id);
			$i = 0;
			foreach ($cs as $c) {
				if ($c->message->eliminado == 0) 
					$i++;
			}
			$cs = $i;
			$cm = MessageDetail::getMessagesByReciever($user_profile->id)->count();
            $courses = Course::getAllCourses();
			$message = Message::find($id);
			$messageLista=null;
			$mensajeRespuesta =MessagesHilo::where('idRespuesta',$message->id)->first();

			if ($mensajeRespuesta!=null) {				
				$message = Message::find($mensajeRespuesta->idOriginal);
				$mensajeRespuestalista =MessagesHilo::where('idOriginal',$mensajeRespuesta->idOriginal)->get();
				$messageLista=Message::latest('messages.created_at')
					->join('messages_detail', 'messages.id', '=', 'messages_detail.message_id')
					->join('users_profile', 'messages_detail.id_from', '=', 'users_profile.id')
					->select('messages.razon as razon', 'messages.adjunto as adjunto', 'messages.created_at as created_at', 'messages.descripcion as descripcion','messages_detail.id as idDetalle', 'users_profile.cargo as cargo', 'users_profile.apellidos as apellidos', 'users_profile.nombres as nombres')
					->groupby('message_id')
					->find($mensajeRespuestalista->pluck('idRespuesta'));
				$users = DB::table('messages_detail')
					->join('users_profile', 'messages_detail.id_to', '=', 'users_profile.id')
					->where('messages_detail.message_id', $mensajeRespuesta->idOriginal)
					->get();
			}else{
				$users = DB::table('messages_detail')
					->join('users_profile', 'messages_detail.id_to', '=', 'users_profile.id')
					->where('messages_detail.message_id', $id)
					->get();
			}
            return view('UsersViews.administrador.notificaciones.show',
                        ['courses' => $courses, 'message' => $message, 'users' => $users, 
                        'countSend' => $cs, 'countMessages' => $cm, 'messageLista' => $messageLista, 'user_session'=>$user_profile]);       
        }catch(Exception $e){
            //logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
        
    }
    public function edit(){
    }

	public function eliminarEnviados(Message $message) {
		$message->eliminado = 1;
		$message->save();

		return back();
	}
	public function eliminarRecibidos(Request $request, Message $message) {
		$user = User::where('userid',$request->userid)->first(); 		
		$messagedetail = MessageDetail::query()
		->where('id_to', $user->id)
		->where('message_id', $message->id)
		->first();
		$messagedetail->eliminado = 1;
		$messagedetail->visto = 1;
		$messagedetail->save();
		return back();
    }
    
    public function enviarMensaje(Request $request){
    	    try{
            
			$userId = User::where('userid', Sentinel::getUser()->id)->first()->profileStudent;
			if ($userId != null) {
				$userId = $userId->idProfile;
				$student = true;
			} else {
				$userId = User::where('userid', Sentinel::getUser()->id)->first();
				$userId = $userId->id;
				$student = null;
			}

            $message = new Message();
            $message->razon = $request->razon;
			$message->descripcion = $request->descripcion;
			$message->idPeriodo = $this->idPeriodoUser();
            if ($request->hasFile('adjunto')) {
				$token = Str::random(3);
				$filename = pathinfo($request->file('adjunto')->getClientOriginalName(), PATHINFO_FILENAME);
				$extension = pathinfo($request->file('adjunto')->getClientOriginalName(), PATHINFO_EXTENSION);
                $request->file('adjunto')->storeAs('public/adjuntos', "{$token}_{$filename}.{$extension}");
                $message->adjunto = "{$token}_{$filename}.{$extension}";
            }

            $message->save();
            
            foreach($request->user as $user){
                $message_detail = new MessageDetail();
                $message_detail->id_from = $userId;
				$message_detail->id_to = $user;
				$message_detail->idPeriodo = $this->idPeriodoUser();
                $message_detail->message_id = $message->id;
                $message_detail->visto = false;
                $message_detail->save();
            }
			if (isset($request->CopiaCorreos)) {
			//si existe la variable 
				if (!empty($request->CopiaCorreos)) {// si no esta vacia
				$Copias = explode(",", $request->CopiaCorreos);
				foreach($Copias as $copia){
					if ($copia!='0') {
					$message_detail = new MessageDetail();
					$message_detail->id_from = $userId;
					$message_detail->id_to = $copia;
					$message_detail->idPeriodo = $this->idPeriodoUser();
					$message_detail->message_id = $message->id;
					$message_detail->visto = false;
					$message_detail->save();
					}
					}
				}
			}
            
            $send = MessageDetail::getMessagesBySender($userId);
			$messages = MessageDetail::getMessagesByReciever($userId);
			if($student == true) {
				return redirect()->route('notificacionesEstudiante');
			} else {
				return redirect()->route('notificaciones');
			}
         }catch(Exception $e){
             return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  "Algo salio mal." ]);
         }
    }
    public function enviarMensajeRespuesta(Request $request){


    	$user = Sentinel::getUser();
		$user_profile = Usuario::find($user->id)->profile->profileStudent;
		if ($user_profile == null) {
				$user = Sentinel::getUser();
				$user_profile = Administrative::findBySentinelid($user->id);
			} 

    	
    	$users = DB::table('messages_detail')
				->join('users_profile', 'messages_detail.id_to', '=', 'users_profile.id')
				->where('messages_detail.message_id', $request->idOriginal)
				->first();
         try{
            
			$userId = User::where('userid', Sentinel::getUser()->id)->first()->profileStudent;
			if ($userId != null) {
				$userId = $userId->idProfile;
				$student = true;
			} else {
				$userId = User::where('userid', Sentinel::getUser()->id)->first();
				$userId = $userId->id;
				$student = null;
			}

            $message = new Message();
            $message->razon = $request->razon;
			$message->descripcion = $request->descripcion;
			$message->idPeriodo = $this->idPeriodoUser();
            if ($request->hasFile('adjunto')) {
				$token = Str::random(3);
				$filename = pathinfo($request->file('adjunto')->getClientOriginalName(), PATHINFO_FILENAME);
				$extension = pathinfo($request->file('adjunto')->getClientOriginalName(), PATHINFO_EXTENSION);
                $request->file('adjunto')->storeAs('public/adjuntos', "{$token}_{$filename}.{$extension}");
                $message->adjunto = "{$token}_{$filename}.{$extension}";
            }

            $message->save();

            $respuesta = new MessagesHilo();
            $respuesta->idOriginal= $request->idOriginal;
            $respuesta->idRespuesta= $message->id;
            $respuesta->save();

            $send = MessageDetail::getMessagesBySender($userId);
			$messages = MessageDetail::getMessagesByReciever($userId);
			if (isset($request->idRespuesta)) {             

			if (!empty($request->idRespuesta)) {
			$usersToResponse = DB::table('messages_detail')
			->join('users_profile', 'messages_detail.id_from', '=', 'users_profile.id')
			->where('messages_detail.message_id', $request->idRespuesta)
			->first();
			$message_detail = new MessageDetail();
			$message_detail->id_from = $userId;
			$message_detail->id_to = $usersToResponse->id;
			$message_detail->idPeriodo = $this->idPeriodoUser();
			$message_detail->message_id = $message->id;
			$message_detail->visto = false;
			$message_detail->save();   
			}
			}else{
				$message_detail = new MessageDetail();
                $message_detail->id_from = $userId;
				$message_detail->id_to = $users->id_from;
				$message_detail->idPeriodo = $this->idPeriodoUser();
                $message_detail->message_id = $message->id;
                $message_detail->visto = false;
                $message_detail->save(); 
			}
			if($student == true) {
				return redirect()->route('notificacionesEstudiante');
			} else {
				return redirect()->route('notificaciones');
			}
         }catch(Exception $e){
             return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  "Algo salio mal." ]);
         }
    }
 
    public function descargarAdjunto($archivo){
        return response()->download(storage_path("app/public/adjuntos/{$archivo}"));    
    }
    public function descargarAdjunto2($archivo){
        return response()->download(storage_path("app/public/adjuntos/{$archivo}"));    
    }
    
    public function enviar(){
        $user = Sentinel::getUser();
        $user_profile = Administrative::findBySentinelid($user->id);
        $cs = MessageDetail::getMessagesBySender($user_profile->id);
		$i = 0;
		foreach ($cs as $c) {
			if ($c->message->eliminado == 0) 
				$i++;
		}
		$cs = $i;
		$cm = MessageDetail::getMessagesByReciever($user_profile->id)->count();

        $courses = Course::getAllCourses();
        $adjunto = ConfiguracionSistema::adjuntoRepresentante();
        return view('UsersViews.administrador.notificaciones.enviar',['courses' => $courses,'countSend' => $cs, 'countMessages' => $cm,'user_profile'=>$user_profile, 'adjunto' => $adjunto ]);
	}
	
	public function homeEstudiante() {
		try {
			if(session('horaInicio') != null && session('user') != null){
				$sessionHora = new BibliotecaReportController;
				$sessionHora->sessionHora();
			  }
			$eliminarMensaje = ConfiguracionSistema::eliminarMensajesEstudiantes();
			$route = 'eliminarRecibidosE';
			$courses = Course::getAllCourses();
			$user = Sentinel::getUser();
			$user_profile = Usuario::find($user->id)->profile->profileStudent;

			if ($user_profile == null) {
				$user = Sentinel::getUser();
				$user_profile = Administrative::findBySentinelid($user->id);
	
			} 
	        session()->put('user_data',$user_profile);
            if($user_profile){
                $cs = MessageDetail::getMessagesBySender($user_profile->idProfile);
				$i = 0;
				foreach ($cs as $c) {
					if ($c->message->eliminado == 0) 
						$i++;
				}
				$cs = $i;
				$cm = MessageDetail::getMessagesByReciever($user_profile->idProfile)->count();
                $m = DB::table('messages_detail')
					->join('messages', 'messages_detail.message_id', '=','messages.id')
					->join('users_profile', 'messages_detail.id_from', '=', 'users_profile.id')
					->where('messages_detail.id_to', $user_profile->idProfile)
					->where('messages_detail.eliminado', 0)
					->where('messages_detail.idPeriodo', $this->idPeriodoUser())
					->orderBy('created_at', 'DESC')
					->select('messages.*', 'messages_detail.visto','users_profile.nombres','users_profile.apellidos','users_profile.cargo')
					->distinct()->get();
                return view(session('rol')->slug.'.notificaciones.index', 
				['courses' => $courses, 'messages' => $m, 'countSend' => $cs, 'countMessages' => $cm, 'eliminarMensaje' => $eliminarMensaje,
				'route' => $route ]); 
            }                
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
	}

	public function notificacionesEnviadosEstudiante($id) {
		dd($id);
	}
	public function notificacionesEnviarEstudiante() {

		$userId = User::where('userid', Sentinel::getUser()->id)->first()->profileStudent->idProfile;

		$curso = Student2::where('idProfile',$userId)->first()
		->profilePerYear->where('idPeriodo', Sentinel::getUser()
		->idPeriodoLectivo)->first()
		->course;
		$cs = MessageDetail::getMessagesBySender($userId);
		$i = 0;
		foreach ($cs as $c) {
			if ($c->message->eliminado == 0) 
				$i++;
		}
		$cs = $i;
		$cm = MessageDetail::getMessagesByReciever($userId)->count();
		$courses = Course::getAllCourses();

		return view('UsersViews.estudiante.notificaciones.enviar',
		['courses' => $courses,'countSend' => $cs, 'countMessages' => $cm, 'curso' =>$curso]);
	}

	public function notificacionesVerEstudiante($id) {
        try{
			$user = Sentinel::getUser();
			$user_profile = Usuario::find($user->id)->profile->profileStudent;

            $detail = MessageDetail::where(['message_id' => $id, 'id_to' => $user_profile->idProfile])->first();
            if($detail != null){
                $detail->visto = true;
                $detail->save();    
            }
			
            $cs = MessageDetail::getMessagesBySender($user_profile->idProfile);
			$i = 0;
			foreach ($cs as $c) {
				if ($c->message->eliminado == 0) 
					$i++;
			}
			$cs = $i;
			$cm = MessageDetail::getMessagesByReciever($user_profile->idProfile)->count();
			
            $courses = Course::getAllCourses();
			$message = Message::find($id);
			$users = DB::table('messages_detail')
				->join('users_profile', 'messages_detail.id_to', '=', 'users_profile.id')
				->where('messages_detail.message_id', $id)
				->get();

				
            return view('UsersViews.estudiante.notificaciones.show',
                        ['courses' => $courses, 'message' => $message, 'users' => $users, 
                        'countSend' => $cs, 'countMessages' => $cm ]);       
        }catch(Exception $e){
            //logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
	}
	public function notificacionesVerEnviadosEstudiante($id) {
        try{
			$user = Sentinel::getUser();
			$user_profile = Usuario::find($user->id)->profile->profileStudent;

            $detail = MessageDetail::where(['message_id' => $id, 'id_to' => $user_profile->id])->first();
            if($detail != null){
                $detail->visto = true;
                $detail->save();    
            }
			
            $cs = MessageDetail::getMessagesBySender($user_profile->idProfile);
			$i = 0;
			foreach ($cs as $c) {
				if ($c->message->eliminado == 0) 
					$i++;
			}
			$cs = $i;
			$cm = MessageDetail::getMessagesByReciever($user_profile->idProfile)->count();
			
            $courses = Course::getAllCourses();
			$message = Message::find($id);
			$users = DB::table('messages_detail')
				->join('users_profile', 'messages_detail.id_to', '=', 'users_profile.id')
				->where('messages_detail.message_id', $id)
				->get();
				
            return view('UsersViews.estudiante.notificaciones.show',
                        ['courses' => $courses, 'message' => $message, 'users' => $users, 
                        'countSend' => $cs, 'countMessages' => $cm ]);       
        }catch(Exception $e){
            //logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
	}

	public function notificacionesEstudianteEnviados() {
		try {
			$eliminarMensaje = ConfiguracionSistema::eliminarMensajesEstudiantes();
			$courses = Course::getAllCourses();
			$route = 'eliminarEnviadosE';
	        $user = Sentinel::getUser();
			$user_profile = Usuario::find($user->id)->profile->profileStudent;

			session()->put('user_data',$user_profile);
            if($user_profile){
				$users = [];
				
				$s = DB::table('messages_detail')
                    ->join('messages', 'messages_detail.message_id', '=','messages.id')
                    ->join('users_profile', function($join) use ($user_profile) {
                        $join->on('messages_detail.id_from', '=', 'users_profile.id')
                            ->where('users_profile.id', $user_profile->idProfile);
                    })
                    ->select('messages_detail.id_from', 'messages.*','users_profile.nombres','users_profile.apellidos', 'users_profile.cargo')
                    ->orderBy('created_at', 'DESC')
                    ->where('messages.eliminado', 0)
                    ->where('messages_detail.idPeriodo', $this->idPeriodoUser())
                    ->distinct()->get();
                $users = [];
                foreach ($s as $m) {
                    $users[$m->id] = DB::table('messages_detail')
                        ->join('users_profile', 'messages_detail.id_to', '=', 'users_profile.id')
                        ->where('messages_detail.message_id', $m->id)
                        ->get();
                }
				$cs = count($s);
				$cm = MessageDetail::getMessagesByReciever($user_profile->idProfile)->count();
                return view(session('rol')->slug.'.notificaciones.enviados', 
				['courses' => $courses, 'messages' => $s, 'countSend' => $cs, 'countMessages' => $cm,
				'route' => $route, 'eliminarMensaje' => $eliminarMensaje, 'users' => $users ]); 
				

            }                
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
	}

	public function eliminarEnviadosE(Message $message) {
		$message->eliminado = 1;
		$message->save();

		return back();
	}

	public function eliminarRecibidosE(Request $request, Message $message) {
		$user = User::where('userid', $request->userid)->first();
		$messagedetail = MessageDetail::query()
		->where('id_to', $user->id)
		->where('message_id', $message->id)
		->first();
		
		$messagedetail->eliminado = 1;
		$messagedetail->visto = 1;
		$messagedetail->save();
		return back();
	}
	public function notificacionesVerEstudianteEnviados() {
		$courses = Course::getAllCourses();
    	try {
	        $user = Sentinel::getUser();
			$user_profile = Usuario::find($user->id)->profile->profileStudent;

			if ($user_profile == null) {
				$user = Sentinel::getUser();
				$user_profile = Administrative::findBySentinelid($user->id);
			}

	        session()->put('user_data',$user_profile);
            if($user_profile){
                $users = [];
                $cs = MessageDetail::getMessagesBySender($user_profile->id)->count();
				$cm = MessageDetail::getMessagesByReciever($user_profile->id)->count();
				if($user_profile->profile != null) {
					$s = DB::table('messages_detail')
					->join('messages', 'messages_detail.message_id', '=','messages.id')
					->join('students2', function($join) use($user_profile) {
								$join->on('messages_detail.id_from', '=', 'students2.id')
									->where('students2.id', '=', $user_profile->id);
					})
					->join('users_profile', 'students2.idProfile', '=', 'users_profile.id')
					->select('messages.*','students2.nombres','students2.apellidos', 'users_profile.cargo')
					->distinct()->get();
				} else {
					$s = DB::table('messages_detail')
					->join('messages', 'messages_detail.message_id', '=','messages.id')
					->join('users_profile', function($join) use($user_profile) {
								$join->on('messages_detail.id_from', '=', 'users_profile.id')
									->where('users_profile.id', '=', $user_profile->id);
					})
					->select('messages.*','users_profile.nombres','users_profile.apellidos','users_profile.cargo')
					->distinct()->get();
				}
                return view(session('rol')->slug.'.notificaciones.index', 
                ['courses' => $courses, 'messages' => $s, 'countSend' => $cs, 'countMessages' => $cm ]); 
            }                
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
	}
}
