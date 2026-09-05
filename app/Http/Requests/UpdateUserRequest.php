<?php
namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateUserRequest extends FormRequest {
 public function authorize(): bool { $target=$this->route('user'); return $this->user()->isAdmin() || ($this->user()->isPetugas() && !$target->isAdmin()); }
 public function rules(): array { $target=$this->route('user'); return ['name'=>['required','string','max:255'],'email'=>['required','email','max:255',Rule::unique('users','email')->ignore($target)],'phone'=>['nullable','string','max:30'],'password'=>['nullable','string','min:8','confirmed'],'role'=>['required',Rule::in($this->user()->isAdmin()?['admin','petugas','customer']:['petugas','customer'])]]; }
}
