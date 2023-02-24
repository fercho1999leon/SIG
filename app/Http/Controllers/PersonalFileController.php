<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\Caja;
use App\Course;
use App\Institution;
use App\Matter;
use App\User;
use App\Usuario;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Sentinel;

class PersonalFileController extends Controller
{

    public function administrativeHome(Request $request)
    {
        try {
            $name = $request->get('search');
            $data = User::query()
                ->search(request('search'))
                ->where('cargo', 'Administrador')
                ->where('id', '!=', session('user_data')->id)
                ->orderBy('apellidos')
                ->paginate(20);
            return view('UsersViews.administrador.fichasPersonales.Administrador.index', compact('data', 'name'));
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'text' => "Algo salio mal."]);
        }
    }

    public function teacherHome(Request $request)
    {
        try {
            $name = $request->get('search');
            $data = User::query()
                ->search(request('search'))
                ->where('cargo', 'Docente')      
                ->orderBy('apellidos')
                ->paginate(20);
            return view('UsersViews.administrador.fichasPersonales.Docente.index', compact('data', 'name'));
        } catch (Exception $e) {

            return redirect()->back()->with('message', ['type' => 'danger', 'text' => "Algo salio mal."]);
        }
    }

    public function studentHome()
    {
        try {
            return view(session('rol')->slug . '.fichasPersonales.estudiantes');
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'text' => "Algo salio mal."]);
        }
    }

    public function representanteUpdate(Administrative $representante, Request $request)
    {
        $this->validate($request, [
            'ci' => 'required|string|max:14',
            'nombres' => 'required|string|between:2,30',
            'apellidos' => 'required|string|between:2,30',
            'sexo' => 'required|in:Femenino,Masculino',
            'fNacimiento' => 'required|date',
            'correo' => [
                'email', 'required',
                Rule::unique('users', 'email')->ignore($representante->user->id),
            ],
            'movil' => 'string|max:10|nullable',
            'bio' => 'string||between:3,300|nullable',
            'dDomicilio' => 'string|between:3,200|nullable',
            'tDomicilio' => 'string|max:10|nullable',
            'cargo' => 'string|nullable',
            'password' => 'string|min:3|max:20|nullable',
            'url_imagen' => 'string|nullable',
            'es_representante' => 'nullable',
        ]);
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('avatars', $request->image, 'public');
            $representante->url_imagen = $path;
            $representante->save();
        }
        $representante->update([
            'ci' => $request->ci,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'sexo' => $request->sexo,
            'fNacimiento' => $request->fNacimiento,
            'correo' => $request->correo,
            'movil' => $request->movil,
            'bio' => $request->bio,
            'dDomicilio' => $request->dDomicilio,
            'tDomicilio' => $request->tDomicilio,
            'profesion' => $request->profesion,
            'lugar_trabajo' => $request->lugar_trabajo,
            'telefono_trabajo' => $request->telefono_trabajo,
            'ex_alumno' => $request->ex_alumno == 'Si' ? 1 : 0,
            'fecha_promocion' => $request->fecha_promocion,
            'fecha_ingreso' => $request->fecha_ingreso,
            'fecha_estado_migratorio' => $request->fecha_estado_migratorio,
            'fecha_exp_pasaporte' => $request->fecha_exp_pasaporte,
            'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte,
            'nacionalidad' => $request->nacionalidad,
        ]);

        $usuario = Usuario::find($representante->userid);
        $usuario->email = $representante->correo;
        $usuario->save();

        if ($request->password != null) {
            $user = Sentinel::findById($representante->userid);
            $credentials = ['password' => $request->password];
            Sentinel::update($user, $credentials);
        }

        return back();
    }

    public function representativeHome()
    {
        try {
            $name = request()->search;
            $data = User::query()
                ->search(request('search'))
                ->where('cargo', 'Representante')
                ->orderBy('apellidos')
                ->paginate(20);
            return view('UsersViews.administrador.fichasPersonales.Representante.index', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'text' => "Algo salio mal."]);
        }
    }

    public function getUpdateUser($type, User $user)
    {
        //dd($user);;
        $validator = \Validator::make(['tipo_usuario' => $type], [
            'tipo_usuario' => ['in:Administrador,Docente,Representante'],
        ], ['tipo_usuario.in' => 'tipo de usuario incorrecto.']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->Messages());
        }

        try {
            if ($user->fNacimiento) {
                $temDate = new \DateTime($user->fNacimiento);
                $user->fNacimiento = $temDate->format('Y-m-d');
            }
            return view('UsersViews.administrador.fichasPersonales.' . $type . '.editar', ['data' => $user]);
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'text' => "Algo salio mal."]);
        }
    }

    public function postUpdateUser(Request $request, User $user)
    {

        //validacion de campos
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('avatars', $request->image, 'public');
            $user->url_imagen = $path;
        }
        $institution = Institution::first();
        //dd($institution->nombre);
        $request->merge([
            'nombreUnidadAcademica' => $institution->nombre,
        ]);
        if ($request->discapacidad == 2) {
            $request->merge([
                'porcentaje_discapacidad' => "NA",
                'numCarnetDiscapacidad' => "NA",
                'tipoDiscapacidad' => "7",
                'tipoEnfermedadCatastrofica' => "6",
            ]);
        }
        if ($request->estaEnPeriodoSabatico == 2) {
            $request->merge([
                'fechaInicioPeriodoSabatico' => "NA",
            ]);
        }
        if ($request->estaCursandoEstudiosId == 8) {
            $request->merge([
                'institucionDondeCursaEstudios' => "NA",
                'paisEstudiosId' => "NA",
                'tituloAObtener' => "NA",
                'poseeBecaId' => "3",
                'tipoBecaId' => "3",
                'montoBeca' => "NA",
                'financiamientoBecaId' => "5",
            ]);
        }
        $this->validate($request, [
            'ci' => 'required|string|max:14',
            'nombres' => 'required|string|between:2,30',
            'apellidos' => 'required|string|between:2,30',
            'sexo' => 'required|in:1,2',
            'fNacimiento' => 'required|date',
            'correo' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($user->user->id),
            ],
            'movil' => 'string|max:10|nullable',
            'bio' => 'string||between:3,300|nullable',
            'dDomicilio' => 'string|between:3,200|nullable',
            'tDomicilio' => 'string|max:10|nullable',
            'cargo' => 'string|nullable',
            'password' => 'string|min:3|max:20|nullable',
            'url_imagen' => 'string|nullable',
            'es_representante' => 'nullable',
        ]);
        //dd($request);
        try {
            $user->update($request->all());
            $user->es_representante = $request->es_representante == 'true' ? 1 : 0;
            $user->save();

            $usuario = Usuario::find($user->userid);
            $usuario->email = $request->correo;
            $usuario->save();
            if (isset($request->password) || isset($request->email)) {
                $user_Sentinel = Sentinel::findById($user->userid);
                $credentials = array();
                if (isset($request->password)) {
                    $credentials['password'] = $request->password;
                }

                Sentinel::update($user_Sentinel, $credentials);
            }
            return redirect()->back()->with('message', ['type' => 'success', 'text' => "Usuario $user->nombres Actualizado."]);
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'text' => "Algo salio mal."]);
        }
    }

    public function getDetailUser($type, User $user)
    {
        $validator = \Validator::make(
            [
                'tipo_usuario' => $type,
            ],
            [

                'tipo_usuario' => [
                    'in:Administrador,Docente,Representante',
                ],
            ],
            [

                'tipo_usuario.in' => 'tipo de usuario incorrecto.',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->Messages());
        }

        try {
            return view('partials.fichas.fichaVer-administrador', ['data' => $user]);
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'text' => "Algo salio mal."]);
        }
    }

    public function representanteShow(Administrative $representante)
    {
        return view('partials.fichas.ficha-verRepresentante', compact('representante'));
    }

    public function postDeleteUser(User $user)
    {
        try {
            $user_Sentinel = Sentinel::findById($user->userid);
            $user_Sentinel->delete();
            return redirect()->back()->with('message', ['type' => 'success', 'text' => "Usuario Eliminado."]);
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'text' => "Algo salio mal."]);
        }
    }

    /*
    API para usar ajax
     */

    public function getAdministrativos()
    {
        $data = Sentinel::getUserRepository()
            ->join('users_profile', 'users_profile.userid', '=', 'users.id')
            ->join('role_users', 'role_users.user_id', '=', 'users.id')
            ->where('role_id', '=', 1)
            ->where('users.id', '<>', session('user_data')->id)
            ->select('users_profile.*')->get();

        return response()->json($data);
    }

    public function getCursos()
    {
        $cursos = Course::getAllCourses();
        return response()->json($cursos);
    }
    public function getCursosDocente()
    {
        $courses = Course::getAllCourses();
        //obtengo los cursos a los cuales el docente imparte materia
        $materias = Matter::with('curso')->distinct()
            ->where('idDocente', session('user_data')->userid)
            ->where('idPeriodo', $this->idPeriodoUser())
            ->pluck('idCurso');

        $courses = Course::find($materias);
        return response()->json($courses);
    }

    public function getEstudiantesConRepresentante()
    {
        $data = DB::table('students2_profile_per_year')
            ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->join('users_profile', 'users_profile.id', '=', 'students2_profile_per_year.idRepresentante')
            ->select('users_profile.id', 'students2.nombres', 'students2.apellidos', 'students2_profile_per_year.idCurso', 'courses.grado', 'courses.paralelo')
            ->get();

        return response()->json($data);
    }
    public function getRepresentanteMateria()
    {
        if ($search = \Request::get('idCurso')) {
            $data = DB::table('students2_profile_per_year')
                ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('users_profile', 'users_profile.id', '=', 'students2_profile_per_year.idRepresentante')
                ->where('courses.id', $search)
                ->select('users_profile.id', 'students2.nombres', 'students2.apellidos', 'students2_profile_per_year.idCurso', 'courses.grado', 'courses.paralelo')
                ->get();

            return response()->json($data);
        }
    }

    public function getDocentes()
    {
        $data = Sentinel::getUserRepository()
            ->join('users_profile', 'users_profile.userid', '=', 'users.id')
            ->join('role_users', 'role_users.user_id', '=', 'users.id')
            ->where('role_id', '=', 4)
            ->select('users_profile.*')
            ->get();
        $courses = Course::getAllCourses();
        return response()->json(compact('data', 'courses'));
    }
    public function getDocentesMateria()
    {
        if ($search = \Request::get('idCurso')) {

            $data = Sentinel::getUserRepository()
                ->join('users_profile', 'users_profile.userid', '=', 'users.id')
                ->join('role_users', 'role_users.user_id', '=', 'users.id')
                ->join('matters', 'users_profile.userid', '=', 'matters.idDocente')
                ->join('courses', 'matters.idCurso', '=', 'courses.id')
                ->where('courses.id', $search)
                ->where('role_id', '=', 4)
                ->select('users_profile.*', 'matters.nombre as materia')
                ->groupby('users_profile.id')
                ->distinct('users_profile.id', 'materia')
                ->get();
            $courses = Course::getAllCourses();
            return response()->json(compact('data', 'courses'));
        }
    }

    public function getEstudiantes()
    {
        $data = DB::table('students2')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->select('students2.idProfile as id', 'students2.nombres', 'students2.apellidos', 'courses.grado', 'courses.paralelo', 'students2_profile_per_year.idCurso', 'students2_profile_per_year.idPeriodo')
            ->whereIn('students2_profile_per_year.tipo_matricula', ['Ordinaria', 'Extraordinaria'])
            ->where('students2_profile_per_year.idPeriodo', $this->idPeriodoUser())
            ->where('students2.idProfile', '!=', null)
            ->get();
        return response()->json($data);
    }
    public function getEstudiantesMateria()
    {if ($search = \Request::get('idCurso')) {
        //return $search;
        $data = DB::table('students2')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->select('students2.idProfile as id', 'students2.nombres', 'students2.apellidos', 'courses.grado', 'courses.paralelo', 'students2_profile_per_year.idCurso', 'students2_profile_per_year.idPeriodo')
            ->whereIn('students2_profile_per_year.tipo_matricula', ['Ordinaria', 'Extraordinaria'])
            ->where('courses.id', $search)
            ->where('students2_profile_per_year.idPeriodo', $this->idPeriodoUser())
            ->where('students2.idProfile', '!=', null)
            ->get();
        return response()->json($data);
    }
    }

    public function getSecretarias()
    {
        $data = Sentinel::getUserRepository()
            ->join('users_profile', 'users_profile.userid', '=', 'users.id')
            ->join('role_users', 'role_users.user_id', '=', 'users.id')
            ->where('role_id', '=', 2)
            ->select('users_profile.*')
            ->get();
        return response()->json($data);
    }
    public function colecturia()
    {
        $users = Administrative::where('cargo', 'Colecturia')->orderBy('apellidos')->paginate(20);
        return view('UsersViews.administrador.fichasPersonales.Colecturia.index', compact(
            'users'
        ));
    }

    public function colecturiaShow(Administrative $colecturia)
    {
        return view('partials.fichas.fichaVer-colecturia', compact('colecturia'));
    }

    public function colecturiaCrear()
    {
        $user = new Administrative;
        return view('UsersViews.administrador.fichasPersonales.Colecturia.crear', compact(
            'user'
        ));
    }

    public function colecturiaEdit(Administrative $user)
    {
        return view('UsersViews.administrador.fichasPersonales.Colecturia.edit', compact(
            'user'
        ));
    }

    public function colecturiaStore(Request $request)
    {
        DB::beginTransaction();
        $this->validate($request, [
            'ci' => 'required|string|max:14',
            'nombres' => 'required|string|between:2,30',
            'apellidos' => 'required|string|between:2,30',
            'sexo' => 'required|in:Femenino,Masculino',
            'fNacimiento' => 'required|date',
            'correo' => 'required|email|unique:users,email',
            'movil' => 'string|max:10|nullable',
            'bio' => 'string||between:3,300|nullable',
            'dDomicilio' => 'string|between:3,200|nullable',
            'tDomicilio' => 'string|max:10|nullable',
            'numero_caja' => 'numeric|nullable',
        ]);

        $user_sentinel = ['email' => $request->correo, 'password' => $request->ci];
        $user = Sentinel::registerAndActivate($user_sentinel);
        $user->idPeriodoLectivo = $this->idPeriodoUser();
        //registra el rol de los usuarios
        $role = Sentinel::findRoleByName($request->perfil);
        $role->users()->attach($user);
        $user->save();

        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('avatars', $request->image, 'public');
        }

        $user_profile = new Administrative;
        $user_profile->ci = $request->ci;
        $user_profile->nombres = $request->nombres;
        $user_profile->apellidos = $request->apellidos;
        $user_profile->sexo = $request->sexo;
        $user_profile->fNacimiento = $request->fNacimiento;
        $user_profile->correo = $request->correo;
        $user_profile->movil = $request->movil;
        $user_profile->bio = $request->bio;
        $user_profile->dDomicilio = $request->dDomicilio;
        $user_profile->tDomicilio = $request->tDomicilio;
        $user_profile->cargo = $request->perfil;
        $user_profile->userid = $user->id;
        $user_profile->created_at = date("Y-m-d H:i:s");
        $user_profile->url_imagen = $path;
        $user_profile->save();
        if ($request->perfil == 'Colecturia') {
            Caja::create([
                'idUser' => $user_profile->id,
                'numero_caja' => $request->numero_caja,
            ]);
        }

        DB::commit();
        $route = $request->perfil == 'Colecturia' ? 'colecturia.index' : 'secretaria.index';
        return redirect()->route($route);
    }

    public function colecturiaUpdate(Request $request, User $user)
    {
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('avatars', $request->image, 'public');
            $user->url_imagen = $path;
        }
        $this->validate($request, [
            'ci' => 'required|string|max:14',
            'nombres' => 'required|string|between:2,30',
            'apellidos' => 'required|string|between:2,30',
            'sexo' => 'required|in:Femenino,Masculino',
            'fNacimiento' => 'required|date',
            'correo' => [
                'email', 'required',
                Rule::unique('users', 'email')->ignore($user->user->id),
            ],
            'movil' => 'string|max:10|nullable',
            'bio' => 'string||between:3,300|nullable',
            'dDomicilio' => 'string|between:3,200|nullable',
            'tDomicilio' => 'string|max:10|nullable',
            'cargo' => 'string|nullable',
            'password' => 'string|min:3|max:20|nullable',
            'url_imagen' => 'string|nullable',
            'numero_caja' => 'numeric|nullable',
        ]);

        $user->update($request->all());

        if ($request->perfil == 'colecturia') {
            $caja = Caja::where('idUser', $user->userid)->first();
            $caja = $request->numero_caja;
            $caja->save();
        }

        $usuario = Usuario::find($user->userid);
        $usuario->email = $request->correo;
        $usuario->save();
        if (isset($request->password) || isset($request->email)) {
            $user_Sentinel = Sentinel::findById($user->userid);
            $credentials = array();
            if (isset($request->password)) {
                $credentials['password'] = $request->password;
            }

            Sentinel::update($user_Sentinel, $credentials);
        }

        return redirect()->back()->with('message', ['type' => 'success', 'text' => "Usuario $user->nombres Actualizado."]);
    }

    public function colecturiaDestroy(Administrative $user)
    {
        $user->user->delete();
        return back();
    }

    public function secretariaIndex()
    {
        $users = Administrative::query()
            ->search(request('search'))
            ->where('cargo', 'Secretaria')
            ->where('id', '!=', session('user_data')->id)
            ->orderBy('apellidos')
            ->paginate(20);
        return view('UsersViews.administrador.fichasPersonales.Secretaria.index', compact(
            'users'
        ));
    }

    public function secretariaShow(Administrative $user)
    {
        $data = $user;
        return view('partials.fichas.fichaVer-administrador', compact('data'));
    }

    public function secretariaCreate()
    {
        $user = new Administrative();
        return view('UsersViews.administrador.fichasPersonales.Secretaria.crear', compact(
            'user'
        ));
    }

    public function secretariaEdit(Administrative $user)
    {
        return view('UsersViews.administrador.fichasPersonales.Secretaria.edit', compact(
            'user'
        ));
    }

    public function secretariaDestroy(Administrative $user)
    {
        $user->user->delete();
        return back();
    }
}
