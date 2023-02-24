<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\ConfiguracionesParcial;
use App\Course;
use App\Fechas;
use App\Institution;
use App\PeriodoLectivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\BibliotecaReportController;
use Sentinel;

class InstitutionController extends Controller
{
    public function index()
    {
        if(session('horaInicio') != null && session('user') != null){
            $sessionHora = new BibliotecaReportController;
            $sessionHora->sessionHora();
          }
        $institution = Institution::first();
        $courses = Course::getAllCourses();
        return view(session('rol')->slug . '.institutions.index', compact('institution', 'courses'));
    }

    public function edit()
    {
        try {
            $user = Sentinel::getUser();
            $user_profile = Administrative::findBySentinelid($user->id);
            $instititution = Institution::first();
            $periodos = PeriodoLectivo::all();
            session()->put('user_data', $user_profile);
            if ($user_profile) {
                $data = DB::table('institution')->where('id', '1')->first();
                return view('UsersViews.administrador.configuraciones.institucionEdicion', compact(
                    'data', 'periodos'
                ));
            }
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }

    public static function getInstitution()
    {
        return Institution::first();
    }

    //Actualización de datos generales institución
    public function updateDatosGenerales(Request $request)
    {
        DB::table('institution')->where('id', '1')->update(['nombre' => $request->nombre]);
        DB::table('institution')->where('id', '1')->update(['ciudad' => $request->ciudad]);
        DB::table('institution')->where('id', '1')->update(['direccion' => $request->direccion]);
        DB::table('institution')->where('id', '1')->update(['correo' => $request->correo]);
        DB::table('institution')->where('id', '1')->update(['telefonos' => $request->telefonos]);
        DB::table('institution')->where('id', '1')->update(['horariosDeAtencion' => $request->horariosDeAtencion]);
        DB::table('institution')->where('id', '1')->update(['jornada' => $request->jornada]);

        DB::table('institution')->where('id', '1')->update(['coordinacionZonal' => $request->coordinacionZonal]);
        DB::table('institution')->where('id', '1')->update(['distrito' => $request->distrito]);
        DB::table('institution')->where('id', '1')->update(['codigoAmie' => $request->codigoAmie]);
        DB::table('institution')->where('id', '1')->update(['parroquia' => $request->parroquia]);
        DB::table('institution')->where('id', '1')->update(['periodoLectivo' => $request->periodoLectivo]);
        DB::table('institution')->where('id', '1')->update(['correoAdmisiones' => $request->correoAdmisiones]);
        if ($request->hasFile('logo')) {
            $nombre_logo = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('public/logo',
                $request->file('logo')->getClientOriginalName());
            DB::table('institution')->where('id', '1')->update(['logo' => $nombre_logo]);
        }
        return redirect("/institucionEdicion");
    }

    public function updateMisionVision(Request $request)
    {
        DB::table('institution')->where('id', '1')->update(['vision' => $request->vision]);
        DB::table('institution')->where('id', '1')->update(['mision' => $request->mision]);

        return redirect("/institucionEdicion");
    }

    public function updateHistoriaAntecedentes(Request $request)
    {
        DB::table('institution')->where('id', '1')->update(['historia' => $request->historia]);
        DB::table('institution')->where('id', '1')->update(['antecedentes' => $request->antecedentes]);

        return redirect("/institucionEdicion");
    }

    public function updateWebOficial(Request $request)
    {
        DB::table('institution')->where('id', '1')->update(['sitioWeb' => $request->sitioWeb]);

        return redirect("/institucionEdicion");
    }

    public function updateRedesSociales(Request $request)
    {
        DB::table('institution')->where('id', '1')->update(['facebook' => $request->facebook]);
        DB::table('institution')->where('id', '1')->update(['twitter' => $request->twitter]);
        DB::table('institution')->where('id', '1')->update(['youtube' => $request->youtube]);
        DB::table('institution')->where('id', '1')->update(['google' => $request->google]);
        DB::table('institution')->where('id', '1')->update(['instagram' => $request->instagram]);

        return redirect("/institucionEdicion");
    }

    public function updateReportesMinisteriales(Request $request)
    {
        DB::table('institution')->where('id', '1')->update(['representante1' => $request->representante1]);
        DB::table('institution')->where('id', '1')->update(['cargo1' => $request->cargo1]);
        DB::table('institution')->where('id', '1')->update(['representante2' => $request->representante2]);
        DB::table('institution')->where('id', '1')->update(['cargo2' => $request->cargo2]);
        DB::table('institution')->where('id', '1')->update(['representante3' => $request->representante3]);
        DB::table('institution')->where('id', '1')->update(['cargo3' => $request->cargo3]);
        DB::table('institution')->where('id', '1')->update(['representante4' => $request->representante4]);
        DB::table('institution')->where('id', '1')->update(['cargo4' => $request->cargo4]);
        DB::table('institution')->where('id', '1')->update(['representante5' => $request->representante5]);
        DB::table('institution')->where('id', '1')->update(['cargo5' => $request->cargo5]);
        DB::table('institution')->where('id', '1')->update(['fechaCertificadoPromocion' => $request->fechaCertificadoPromocion]);

        return redirect("/institucionEdicion");
    }

    public function schoolYear()
    {
        $fechaParcial = ConfiguracionesParcial::getParcial();
        dd($fechaParcial);
        $fechap1q1FI = Fechas::fechaParciales($fechaParcial->p1q1FI);
        $fechap1q1FF = Fechas::fechaParciales($fechaParcial->p1q1FF);
        $fechap2q1FI = Fechas::fechaParciales($fechaParcial->p2q1FI);
        $fechap2q1FF = Fechas::fechaParciales($fechaParcial->p2q1FF);
        $fechap3q1FI = Fechas::fechaParciales($fechaParcial->p3q1FI);
        $fechap3q1FF = Fechas::fechaParciales($fechaParcial->p3q1FF);
        $fechaexq1FI = Fechas::fechaParciales($fechaParcial->exq1FI);
        $fechaexq1FF = Fechas::fechaParciales($fechaParcial->exq1FF);

        $fechap1q2FI = Fechas::fechaParciales($fechaParcial->p1q2FI);
        $fechap1q2FF = Fechas::fechaParciales($fechaParcial->p1q2FF);
        $fechap2q2FI = Fechas::fechaParciales($fechaParcial->p2q2FI);
        $fechap2q2FF = Fechas::fechaParciales($fechaParcial->p2q2FF);
        $fechap3q2FI = Fechas::fechaParciales($fechaParcial->p3q2FI);
        $fechap3q2FF = Fechas::fechaParciales($fechaParcial->p3q2FF);
        $fechaexq2FI = Fechas::fechaParciales($fechaParcial->exq2FI);
        $fechaexq2FF = Fechas::fechaParciales($fechaParcial->exq2FF);

        $courses = Course::getAllCourses();
        return view('UsersViews.administrador.institucion.lectivo.index', compact(
            'fechap1q1FI', 'fechap1q1FF', 'fechap2q1FI', 'fechap2q1FF',
            'fechap3q1FI', 'fechap3q1FF', 'fechaexq1FI', 'fechaexq1FF', 'fechap1q2FI', 'fechap1q2FF', 'fechap2q2FI',
            'fechap2q2FF', 'fechap3q2FI', 'fechap3q2FF', 'fechaexq2FI', 'fechaexq2FF', 'courses'
        ));
    }

}
