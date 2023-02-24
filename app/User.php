<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users_profile';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*
    protected $fillable = [
    'ci', 'nombres', 'apellidos', 'correo', 'sexo', 'fNacimiento', 'movil', 'bio', 'dDomicilio', 'tDomicilio', 'cargo', 'url_imagen'
    ];
     */

    protected $fillable = [
        'ci', 'nombres', 'apellidos', 'correo', 'sexo', 'fNacimiento', 'movil', 'bio', 'dDomicilio', 'tDomicilio', 'cargo', 'url_imagen',
        'tipoDocumentoId', 'genero', 'estadocivilId', 'etniaId', 'pueblo_nacionalidadId', 'provinciaSufragio', 'discapacidad', 'porcentajeDiscapacidad',
        'numCarnetDiscapacidad', 'tipoEnfermedadCatastrofica', 'paisNacionalidadId', 'nivelFormacion', 'fechaIngresoIES', 'fechaSalidaIES',
        'relacionLaboralIESId', 'ingresoConConcursoMeritos', 'escalafonDocenteId', 'tiempoDedicacionId', 'salarioMensual', 'docenciaTecnicoSuperior',
        'docenciaTecnologico', 'estaEnPeriodoSabatico', 'estaCursandoEstudiosId', 'fechaInicioPeriodoSabatico', 'institucionDondeCursaEstudios', 'paisEstudiosId',
        'tituloAObtener', 'poseeBecaId', 'tipoBecaId', 'montoBeca', 'financiamientoBecaId', 'nombreUnidadAcademica', 'nroasignaturasdocente',
        'nroHorasLaborablesSemanaEnCarreraPrograma', 'nroHorasClaseSemanaCarreraPrograma', 'nroHorasClaseSemanaCarreraPrograma',
        'nroHorasInvestigacionSemanaCarreraPrograma', 'nroHorasAdministrativasSemanaCarreraPrograma',
        'nroHorasOtrasActividadesSemanaCarreraPrograma', 'nroHorasVinculacionSociedad', 'pubRevistasCienInIndexadasId', 'numPubRevistasCientifIndexadas',
    ];
    public function user()
    {
        return $this->belongsTo('App\Usuario', 'userid');
    }

    public static function getDocentes()
    {
        return User::query()
            ->where('cargo', 'Docente')
            ->orderBy('apellidos')
            ->get();
    }
    public function profileStudent()
    {
        return $this->hasOne('App\Student2', 'idProfile');
    }

    public function curso()
    {
        return $this->hasOne('App\Course', 'idProfesor');
    }

    public function observacionAulica()
    {
        return $this->hasOne('App\ObservacionesAulicas', 'idDocente');
    }

    public function scopeSearch($query, $search)
    {
        $query->when($search, function ($query, $search) {
            $query->where('nombres', 'like', "%{$search}%")
                ->orWhere('apellidos', 'like', "%{$search}%");
        });
    }
}
