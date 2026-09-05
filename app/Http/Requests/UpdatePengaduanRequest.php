<?php
namespace App\Http\Requests;
class UpdatePengaduanRequest extends StorePengaduanRequest {
 public function authorize(): bool { return $this->user()->can('update', $this->route('pengaduan')); }
}
