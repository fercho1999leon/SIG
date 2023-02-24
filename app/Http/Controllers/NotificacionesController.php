<?php

namespace App\Http\Controllers;

use App\Notificaciones;
use Illuminate\Http\Request;
use Sentinel;

class NotificacionesController extends Controller
{
    public function indexAll() {
		$id = $this->userProfile();
		$notificaciones = Notificaciones::query()
			->where('idUser', $id)
			->where('idPeriodo', $this->idPeriodoUser())
			->orderBy('created_at', 'DESC')
			->paginate(10);
		return view('UsersViews.administrador.notificaciones.allNotifications', compact(
			'notificaciones'
		));
	}

	public function updateLeido() {
		$notificaciones = Notificaciones::query()
			->where('idUser', Sentinel::getUser()->id)
			->orderBy('created_at', 'DESC')
			->get();

		foreach ($notificaciones as $notificacion) {
			$notificacion->leido = 1;
			$notificacion->save();
		}

		return back();
	}

	public function marcarLeido(Notificaciones $notificacion) {
		$notificacion->leido = 1;
		$notificacion->save();
	}
	public function userProfile() {
		$user_profile = session('user_data');
		if ($user_profile->userid != null) {
			$id = $user_profile->userid;
		} else {
			$id = $user_profile->profile->userid;
		}

		return $id;
	}
}
