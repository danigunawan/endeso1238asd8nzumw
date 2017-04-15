<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\HomeController;

class PesananHomestay extends Model
{
		public function scopeStatus($query, $kamars,$request)
		{

			$query->where('id_kamar',$kamars->id_kamar)->where(function ($query) use ($request) {
                  $query->where('check_in',HomeController::tanggal_mysql($request->dari_tanggal))->orwhere( function ($query) use ($request) {
                    $query->where(function ($query) use ($request) {
                      $query->where('check_in','<',HomeController::tanggal_mysql($request->dari_tanggal))->where('check_out','>',HomeController::tanggal_mysql($request->dari_tanggal));
                        })->orwhere(function($query) use ($request) {
                         $query->where('check_in','<',HomeController::tanggal_mysql($request->sampai_tanggal))->where('check_out','>',HomeController::tanggal_mysql($request->dari_tanggal));
                          });
                        });
                      })->where(function($query) use ($request) {
                $query->where('check_out',HomeController::tanggal_mysql($request->sampai_tanggal))
                      ->orwhere(function($query) use ($request){
                        $query->where('check_out','>=',HomeController::tanggal_mysql($request->sampai_tanggal))->where('check_in','<=',HomeController::tanggal_mysql($request->sampai_tanggal));
                        })->orwhere(function($query) use ($request) {
                           $query->where('check_out','<',HomeController::tanggal_mysql($request->sampai_tanggal))->where('check_in','<=',HomeController::tanggal_mysql($request->sampai_tanggal));
                          });
                            });

              return $query;
		
		}    
}


