<?php
namespace App\Http\Controllers;
use App\Http\Requests\UpdatePasswordRequest; use App\Http\Requests\UpdateProfileRequest; use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller {
 public function show(){ return view('profile.show'); }
 public function edit(){ return view('profile.edit'); }
 public function update(UpdateProfileRequest $request){ $request->user()->update($request->validated()); return redirect()->route('profile.show')->with('success','Profil berhasil diperbarui.'); }
 public function password(){ return view('profile.password'); }
 public function updatePassword(UpdatePasswordRequest $request){ $request->user()->update(['password'=>Hash::make($request->password)]); return redirect()->route('profile.show')->with('success','Password berhasil diperbarui.'); }
}
