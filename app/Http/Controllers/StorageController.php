<?php

namespace App\Http\Controllers;

use App\ArchivoBase64;
use App\ArchivosInfo;
use Illuminate\Support\Facades\Log;

class StorageController extends Controller
{
    public static function StorageSql($file,$url,$name,$extension,$userId,$idPeriodo){
        try {
            $fileExist = ArchivosInfo::where('ruta_archivo',$url)
                ->where('user_id',$userId)
                ->count();
            $archiB64 = new ArchivoBase64();
            $archi = new ArchivosInfo();
            if($fileExist===0){
                $file = base64_encode(file_get_contents($file->getRealPath()));
                
                $archiB64->contenido_archivo = $file;
                $archiB64->save();
                
                $archi->nombre_archivo = $name;
                $archi->extension_archivo = $extension;
                $archi->ruta_archivo = $url;
                $archi->archivos_base64_id = $archiB64->id;
                $archi->user_id = $userId;
                $archi->idPeriodo = $idPeriodo;
                $archi->save();
                return response('Ingreso correctamente',201);
            }
            return response('Error el archivo se encuentra duplicado',501);
        } catch (\Illuminate\Database\QueryException $e) {
            $archiB64->delete();
            $archi->delete();
            Log::error("Error en el procedimiento de almacenado del archivo" . $e->getMessage());
            return response('Error en el procedimiento de almacenado del archivo'. $e->getMessage(),501);
        }
        
    }
    public static function DelectSqlStorage($url, $userId, $idPeriodo){
        try {
            ArchivoBase64::join('archivos_info','archivos_base64.id','=','archivos_info.archivos_base64_id')
                ->where('ruta_archivo',$url)
                ->where('user_id',$userId)
                ->where('idPeriodo',$idPeriodo)
                ->delete();
                return response('Se elimino correctamente',201);
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error("Error en el procedimiento de borrado del archivo" . $e->getMessage());
            return response('Error en el procedimiento de borrado del archivo'. $e->getMessage(),501);
        }
    }

    public static function DelectSqlStorageId($id){
        try {
            ArchivoBase64::join('archivos_info','archivos_base64.id','=','archivos_info.archivos_base64_id')
            ->where('archivos_info.id', $id)
            ->delete();
            return response('Se elimino correctamente',201);
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error("Error en el procedimiento de borrado del archivo" . $e->getMessage());
            return response('Error en el procedimiento de borrado del archivo'. $e->getMessage(),501);
        }
    }

    public static function DownloadSqlStorage($url, $userId, $idPeriodo){
        try {
            $fileSQL = ArchivoBase64::join('archivos_info','archivos_base64.id','=','archivos_info.archivos_base64_id')
            ->where('ruta_archivo',$url)
            ->where('user_id',$userId)
            ->where('idPeriodo',$idPeriodo)
            ->first();
            if($fileSQL != null && $fileSQL->count()!=0){
                $file = base64_decode($fileSQL->contenido_archivo);
                return response($file,201);
            }
            return response('Archivo no existe en la base de datos para corregir eliminar el archivo y volverlo a cargar.',502);
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error("Error en el procedimiento de borrado del archivo" . $e->getMessage());
            return response('Error en el procedimiento de extracion del archivo'. $e->getMessage(),501);
        }
    }

    public static function DownloadSqlStorageId($id){
        try {
            $fileSQL = ArchivoBase64::where('id',$id)
            ->first();
            if($fileSQL != null && $fileSQL->count()!=0){
                $file = base64_decode($fileSQL->contenido_archivo);
                return response($file,201);
            }
            return response('Archivo no existe en la base de datos para corregir eliminar el archivo y volverlo a cargar.',502);
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error("Error en el procedimiento de borrado del archivo" . $e->getMessage());
            return response('Error en el procedimiento de extracion del archivo'. $e->getMessage(),501);
        }
    }
}
