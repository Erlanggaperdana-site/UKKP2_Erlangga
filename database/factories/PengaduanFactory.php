<?php
namespace Database\Factories;
use App\Models\User; use Illuminate\Database\Eloquent\Factories\Factory;
class PengaduanFactory extends Factory {
 public function definition(): array { return ['nomor_pengaduan'=>'PGD-'.fake()->date('Ymd').'-'.strtoupper(fake()->unique()->bothify('??###?')),'user_id'=>User::factory(),'nomor_telepon'=>fake()->numerify('08##########'),'email'=>fake()->safeEmail(),'isi_pengaduan'=>fake()->paragraph(),'foto'=>null]; }
}
