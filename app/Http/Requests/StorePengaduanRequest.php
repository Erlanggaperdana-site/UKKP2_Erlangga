<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StorePengaduanRequest extends FormRequest {
 public function authorize(): bool { return $this->user()->can('create', \App\Models\Pengaduan::class); }
 public function rules(): array { return ['nomor_telepon'=>['required','string','max:30'],'email'=>['required','email','max:255'],'isi_pengaduan'=>['required','string','max:5000'],'foto'=>['nullable','image','mimes:jpg,jpeg,png,webp','max:2048']]; }
}
