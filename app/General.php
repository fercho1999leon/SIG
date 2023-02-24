<?php
namespace App;
	class General
	{
		public static $supplies = array('TAREAS','ACT. GRUPAL','ACT. INDIVIDUAL','LECCION','EVALUACION');

		public static function getSeccion($value){
			$EI = 'Educación Inicial';
			$EGB = 'Educación General Basica';
			$BGU = 'Bachillerato General Unificado';
			$todos = 'Todos';
			switch ($value) {
				case 'EI':return $EI;break;
				case 'EGB':return $EGB;break;
				case 'BGU':return $BGU;break;
				case 'todos':return $todos;break;
				default:return '';break;
			}
		}
	}