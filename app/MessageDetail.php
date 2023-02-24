<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;
class MessageDetail extends Model
{
    protected $table = 'messages_detail';
    protected $fillable = ['id_from','id_to','message_id'];

    public function message(){
        return $this->belongsTo('App\Message', 'message_id');
    }

    public static function getMessagesBySender($idSender){
        try {
			// $message_detail
			return MessageDetail::query()
			->where('id_from',$idSender)
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->get()
			->unique('message_id');
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getMessagesByReciever($idReciever){
        try {
			return MessageDetail::query()
			->where('id_to',$idReciever)
			->where('eliminado', 0)
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->get()
			->unique('message_id');
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getNewMessages($idReciever){
        try {
			return MessageDetail::where(['id_to' => $idReciever, 'visto' => 0 ])
				->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
				->get()
				->unique('message_id');
        } catch (Exception $e) {
            return null;
        }
    }
}
