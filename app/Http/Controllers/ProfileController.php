<?php
namespace App\Http\Controllers;
use App\Http\Requests\UpdatePasswordRequest; use App\Http\Requests\UpdateProfileRequest; use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller {
 public function show(){ return redirect()->route('settings.index'); }
 public function edit(){ return redirect()->route('settings.index'); }
 public function update(UpdateProfileRequest $request){ $request->user()->update($request->validated()); return redirect()->route('settings.index')->with('success','Profil berhasil diperbarui.'); }
 public function password(){ return redirect()->route('settings.index'); }
 public function updatePassword(UpdatePasswordRequest $request){ $request->user()->update(['password'=>Hash::make($request->password)]); return redirect()->route('settings.index')->with('success','Password berhasil diperbarui.'); }
}
