<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\User;
use App\Kamar;
use Illuminate\Support\Facades\DB;



class PesananHomestay extends Model
{


    protected $fillable = ['id_kamar','check_in','check_out','id_user','total_harga','harga_endeso','harga_pemilik','harga_makan','jumlah_malam','jumlah_orang','nama','no_telp','no_ktp','email','status_pesanan'];

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
                            })->where('status_pesanan','<','4');

              return $query;
		
		}

    public function scopeBatal($query){
        $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF(NOW(),created_at))/ 60'),'>','30')->where('status_pesanan','0')->update(['status_pesanan' => '5']);

        return $query;
    }


    public static function sendInvoice($total_harga_endeso,$id_pesanan,$rekening_tujuan,$email,$nama_pemesan)
    {
        
    $user = Auth::user();
    
    $user->name =  $nama_pemesan;

      Mail::send('emails.invoice', compact('user','total_harga_endeso','id_pesanan','rekening_tujuan'), function($m)use($user,$email,$nama_pemesan) {
    $m->to($email, $nama_pemesan)->subject('Invoice Homestay Endeso');

    });

    }

     public static function sendPetunjukCheckin($total_harga_warga,$detail_kamar,$pesanan_homestay)
    {
      
      $user = User::find($pesanan_homestay->id_user);

    $email = $pesanan_homestay->email;
    $nama_pemesan = $pesanan_homestay->nama;
    $user->nama = $nama_pemesan;

     Mail::send('emails.petunjuk_check', compact('user','total_harga_warga','detail_kamar','pesanan_homestay'), function($m)use($user,$email,$nama_pemesan) {
    $m->to($email, $nama_pemesan)->subject('Petunjuk CheckIn Endeso');

    });

    }


    public function sendCheckout($pesanan_homestay)
    {
         
    $user = Auth::user()->find($pesanan_homestay->id_user);

    $email = $pesanan_homestay->email;
    $nama_pemesan = $pesanan_homestay->nama;
    $user->nama = $nama_pemesan;

    Mail::send('pemesanan.checkout_homestay', compact('user','pesanan_homestay','kategori'), function($m)use($user,$email,$nama_pemesan) {
    $m->to($email, $nama_pemesan)->subject('Thank You & Review (Endeso)');

    });

    }

    public function kamar()
    {
    return $this->belongsTo('App\Kamar','id','id_kamar');
    } 

    public function user()
    {
    return $this->belongsTo('App\User','id_user');
    }
}


