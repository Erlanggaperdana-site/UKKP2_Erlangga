<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller {
 public function showLogin(){ return view('auth.login'); }
 public function login(Request $request){ $credentials=$request->validate(['email'=>['required','email'],'password'=>['required']]); if(!Auth::attempt($credentials,$request->boolean('remember'))) return back()->withErrors(['email'=>'Email atau password tidak sesuai.'])->onlyInput('email'); $request->session()->regenerate(); return redirect()->route('dashboard'); }
 public function showRegister(){ return view('auth.register'); }
 public function register(Request $request){ $data=$request->validate(['name'=>['required','string','max:255'],'email'=>['required','email','unique:users,email'],'phone'=>['nullable','string','max:30'],'password'=>['required','string','min:8','confirmed']]); $user=User::create(['name'=>$data['name'],'email'=>$data['email'],'phone'=>$data['phone']??null,'role'=>'customer']); $user->password=Hash::make($data['password']); $user->save(); Auth::login($user); return redirect()->route('dashboard')->with('success','Registrasi berhasil. Selamat datang!'); }
 public function logout(Request $request){ Auth::logout(); $request->session()->invalidate(); $request->session()->regenerateToken(); return redirect()->route('login')->with('success','Anda telah logout.'); }
}
