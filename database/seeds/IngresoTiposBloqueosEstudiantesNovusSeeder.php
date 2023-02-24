<?php

use Illuminate\Database\Seeder;
use App\Student2Profile;

class IngresoTiposBloqueosEstudiantesNovusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //['idStudent','tipo_bloqueo'],
        $students = array(
        	['11','Colecturia'],
        	['11','Academico'],
			['34','Colecturia'],
			['37','Colecturia'],
			['42','Colecturia'],
			['51','Colecturia'],
			['59','Colecturia'],
			['84','Colecturia'],
			['96','Colecturia'],
			['97','Colecturia'],
			['99','Colecturia'],
			['130','Colecturia'],
			['132','Comportamiento'],
			['137','Comportamiento'],
			['145','Colecturia'],
			['158','Colecturia'],
			['176','Colecturia'],
			['184','Colecturia'],
			['205','Colecturia'],
			['212','Colecturia'],
			['218','Colecturia'],
			['241','Colecturia'],
			['281','Colecturia'],
			['285','Colecturia'],
			['309','Comportamiento'],
			['314','Colecturia'],
			['318','Colecturia'],
			['326','Colecturia'],
			['327','Comportamiento'],
			['328','Colecturia'],
			['344','Colecturia'],
			['361','Comportamiento'],
			['370','Colecturia'],
			['383','Colecturia'],
			['384','Comportamiento'],
			['385','Colecturia'],
			['386','Comportamiento'],
			['404','Comportamiento'],
			['411','Comportamiento'],
			['418','Colecturia'],
			['426','Colecturia'],
			['427','Comportamiento'],
			['429','Comportamiento'],
			['435','Colecturia'],
			['436','Colecturia'],
			['439','Comportamiento'],
			['444','Colecturia'],
			['446','Colecturia'],
			['454','Comportamiento'],
			['459','Comportamiento'],
			['463','Colecturia'],
			['474','Comportamiento'],
			['476','Colecturia'],
			['477','Comportamiento'],
			['495','Comportamiento'],
			['513','Colecturia'],
			['516','Comportamiento'],
			['523','Comportamiento'],
			['524','Comportamiento'],
			['525','Comportamiento'],
			['531','Comportamiento'],
			['534','Colecturia'],
			['543','Comportamiento'],
			['547','Comportamiento'],
			['553','Colecturia'],
			['577','Comportamiento'],
			['578','Colecturia'],
			['580','Colecturia'],
			['590','Colecturia'],
			['591','Comportamiento'],
			['593','Comportamiento'],
			['594','Comportamiento'],
			['597','Colecturia'],
			['603','Colecturia'],
			['612','Comportamiento'],
			['619','Colecturia'],
			['620','Colecturia'],
			['629','Colecturia'],
			['632','Colecturia'],
			['634','Comportamiento'],
			['643','Colecturia'],
			['654','Colecturia'],
			['659','Colecturia'],
			['663','Comportamiento'],
			['665','Colecturia'],
			['666','Colecturia'],
			['674','Colecturia'],
			['676','Comportamiento'],
			['686','Colecturia'],
			['690','Comportamiento'],
			['692','Colecturia'],
			//Academico
			['427','Academico'],
			['444','Academico'],
			['454','Academico'],
			['418','Academico'],
			['426','Academico'],
			['439','Academico'],
			['440','Academico'],
			['441','Academico'],
			['446','Academico'],
			['463','Academico'],
			['476','Academico'],
			['513','Academico'],
			['534','Academico'],
			['571','Academico'],
			['579','Academico'],
			['557','Academico'],
			['580','Academico'],
			['593','Academico'],
			['620','Academico'],
			['629','Academico'],
			['630','Academico'],
			['633','Academico'],
			['585','Academico'],
			['591','Academico'],
			['599','Academico'],
			['601','Academico'],
			['603','Academico'],
			['624','Academico'],
			['632','Academico'],
			['634','Academico'],
			['639','Academico'],
			['643','Academico'],
			['644','Academico'],
			['646','Academico'],
			['655','Academico'],
			['663','Academico'],
			['654','Academico'],
			['656','Academico'],
			['664','Academico'],
			['665','Academico'],
			['666','Academico'],
			['675','Academico'],
			['683','Academico'],
			['690','Academico'],
        );
	    //echo count($students);
	    for($i=0; $i < count($students); $i++){
	    	$student = Student2Profile::findOrFail($students[$i][0]);
	    	//echo $students[$i][0].'_'.$student->tipo_bloqueo.'      ';
	    	$idBloqueo='';
	    	switch ($students[$i][1]){
	    		case 'Condicionado':
	    			$idBloqueo=1;
	    			break;
	    		case 'Comportamiento':
	    			$idBloqueo=2;
	    			break;
	    		case 'Asistencia':
	    			$idBloqueo=3;
	    			break;
	    		case 'Colecturia':
	    			$idBloqueo=4;
	    			break;
	    		case 'DECE':
	    			$idBloqueo=5;
	    			break;
	    		case 'Academico':
	    			$idBloqueo=6;
	    			break;
	    	}
	    	\DB::table('students2_profile_per_year_tipo_bloqueos')->insert([
                'idStudent' => $students[$i][0],
                'idBloqueo' =>  $idBloqueo,
        	]);
        	//INSERT INTO `students2_profile_per_year_tipo_bloqueos` (`id`, `idStudent`, `idBloqueo`, `created_at`, `updated_at`) VALUES (NULL, '100', '6', NULL, NULL);
	    }
	    
    }
}
