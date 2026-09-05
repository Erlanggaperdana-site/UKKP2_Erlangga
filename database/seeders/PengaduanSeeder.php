<?php
namespace Database\Seeders;
use App\Models\Pengaduan; use App\Models\User; use Illuminate\Database\Seeder;
class PengaduanSeeder extends Seeder { public function run(): void { $customers=User::where('role','customer')->get(); foreach($customers as $i=>$customer) Pengaduan::updateOrCreate(['nomor_pengaduan'=>'PGD-DEMO-'.str_pad((string)($i+1),4,'0',STR_PAD_LEFT)],['user_id'=>$customer->id,'nomor_telepon'=>$customer->phone,'email'=>$customer->email,'isi_pengaduan'=>'Data pengaduan contoh untuk kebutuhan demonstrasi aplikasi.']); } }
