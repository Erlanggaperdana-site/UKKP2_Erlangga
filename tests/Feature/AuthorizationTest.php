<?php
namespace Tests\Feature;
use App\Models\Pengaduan; use App\Models\User; use Illuminate\Foundation\Testing\RefreshDatabase; use Tests\TestCase;
class AuthorizationTest extends TestCase {
 use RefreshDatabase;
 public function test_customer_cannot_access_user_management(): void { $this->actingAs(User::factory()->create(['role'=>'customer']))->get('/users')->assertForbidden(); }
 public function test_petugas_cannot_create_admin(): void { $petugas=User::factory()->create(['role'=>'petugas']); $this->actingAs($petugas)->post('/users',['name'=>'New Admin','email'=>'newadmin@example.com','phone'=>'08','password'=>'password123','password_confirmation'=>'password123','role'=>'admin'])->assertSessionHasErrors('role'); $this->assertDatabaseMissing('users',['email'=>'newadmin@example.com']); }
 public function test_customer_can_only_view_own_pengaduan(): void { $customer=User::factory()->create(['role'=>'customer']); $other=Pengaduan::factory()->create(); $this->actingAs($customer)->get(route('pengaduans.show',$other))->assertForbidden(); }
 public function test_customer_can_open_the_new_pengaduan_form(): void { $customer=User::factory()->create(['role'=>'customer']); $this->actingAs($customer)->get(route('pengaduans.create'))->assertOk(); }
 public function test_petugas_can_view_but_cannot_modify_pengaduan(): void { $petugas=User::factory()->create(['role'=>'petugas']); $pengaduan=Pengaduan::factory()->create(); $this->actingAs($petugas)->get(route('pengaduans.show',$pengaduan))->assertOk(); $this->actingAs($petugas)->delete(route('pengaduans.destroy',$pengaduan))->assertForbidden(); }
 public function test_admin_can_manage_pengaduan(): void { $admin=User::factory()->create(['role'=>'admin']); $pengaduan=Pengaduan::factory()->create(); $this->actingAs($admin)->delete(route('pengaduans.destroy',$pengaduan))->assertRedirect(route('pengaduans.index')); $this->assertDatabaseMissing('pengaduans',['id'=>$pengaduan->id]); }
}
