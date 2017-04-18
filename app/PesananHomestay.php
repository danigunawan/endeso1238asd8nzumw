<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Mail;
use Auth;


class PesananHomestay extends Model
{


    protected $fillable = ['id_kamar','check_in','check_out','id_user','total_harga','harga_endeso','harga_pemilik','harga_makan','jumlah_malam','jumlah_orang','nama','no_telp','no_ktp','email'];

		public function scopeStatus($query, $id_kamar,$dari_tanggal,$sampai_tanggal)
		{

			$query->where('id_kamar',$id_kamar)->where(function ($query) use ($dari_tanggal,$sampai_tanggal) {
                  $query->where('check_in',HomeController::tanggal_mysql($dari_tanggal))->orwhere( function ($query) use ($dari_tanggal,$sampai_tanggal) {
                    $query->where(function ($query) use ($dari_tanggal,$sampai_tanggal) {
                      $query->where('check_in','<',HomeController::tanggal_mysql($dari_tanggal))->where('check_out','>',HomeController::tanggal_mysql($dari_tanggal));
                        })->orwhere(function($query) use ($dari_tanggal,$sampai_tanggal) {
                         $query->where('check_in','<',HomeController::tanggal_mysql($sampai_tanggal))->where('check_out','>',HomeController::tanggal_mysql($dari_tanggal));
                          });
                        });
                      })->where(function($query) use ($dari_tanggal,$sampai_tanggal) {
                $query->where('check_out',HomeController::tanggal_mysql($sampai_tanggal))
                      ->orwhere(function($query) use ($dari_tanggal,$sampai_tanggal){
                        $query->where('check_out','>=',HomeController::tanggal_mysql($sampai_tanggal))->where('check_in','<=',HomeController::tanggal_mysql($sampai_tanggal));
                        })->orwhere(function($query) use ($dari_tanggal,$sampai_tanggal) {
                           $query->where('check_out','<',HomeController::tanggal_mysql($sampai_tanggal))->where('check_in','<=',HomeController::tanggal_mysql($sampai_tanggal));
                          });
                            });

              return $query;
		
		}


    public static function sendInvoice($total_harga_endeso)
    {
        
    $user = Auth::user();
    
    Mail::send('emails.invoice', compact('user','total_harga_endeso'), function($m)use($user) {
    $m->to($user->email, $user->name)->subject('Invoice Homestay Endeso');

    });

    }


}


