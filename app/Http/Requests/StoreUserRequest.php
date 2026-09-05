<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreUserRequest extends FormRequest {
 public function authorize(): bool { return $this->user()->isAdmin() || $this->user()->isPetugas(); }
 public function rules(): array { return ['name'=>['required','string','max:255'],'email'=>['required','email','max:255','unique:users,email'],'phone'=>['nullable','string','max:30'],'password'=>['required','string','min:8','confirmed'],'role'=>['required',Rule::in($this->user()->isAdmin()?['admin','petugas','customer']:['petugas','customer'])]]; }
}
