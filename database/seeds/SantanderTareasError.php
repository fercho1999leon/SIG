<?php

use App\Activity;
use App\Deber;
use Illuminate\Database\Seeder;

class SantanderTareasError extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idStudents = [
			71,28,72,75,29,30,31,32,33,34,35,74,36,37,39,38,69,40,41,66,42,43,
			65,44,47,48,45,46,50,52,53,70,73
		];

		$idActivities = [
			321,335,337,333,308,339,338,322,309,341,340
		];
		$i = 1;
		foreach ($idActivities as $activity) {
			$activity = Activity::find($activity);
			foreach ($idStudents as $idStudent) {
				$deber = Deber::query()
					->where('idEstudiante', $idStudent)
					->where('idActividad', $activity->id)
					->where('idProfesor', $activity->supply->idDocente)
					->first();
				
				if ($deber == null) {
					$deber = new Deber;
					$deber->idActividad = $activity->id;
					$deber->idEstudiante = $idStudent;
					$deber->idProfesor = $activity->supply->idDocente;
					$deber->save();
				}
			}
		}
    }
}
