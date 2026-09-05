<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest; use App\Http\Requests\UpdateUserRequest; use App\Models\User; use Illuminate\Http\Request; use Illuminate\Support\Facades\Hash;
class UserController extends Controller {
 private function allowed(User $target): void { $actor=request()->user(); abort_unless($actor->isAdmin() || ($actor->isPetugas() && !$target->isAdmin()),403); }
 public function index(Request $request){ $query=User::query(); if($request->filled('search')) $query->where(fn($q)=>$q->where('name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%')); if($request->filled('role')) $query->where('role',$request->role); if($request->user()->isPetugas()) $query->where('role','!=','admin'); return view('users.index',['users'=>$query->latest()->paginate(10)->withQueryString()]); }
 public function create(){ return view('users.form',['user'=>new User(),'roles'=>request()->user()->isAdmin()?['admin','petugas','customer']:['petugas','customer']]); }
 public function store(StoreUserRequest $request){ $data=$request->safe()->except('password'); $user=User::create($data); $user->password=Hash::make($request->password); $user->save(); return redirect()->route('users.index')->with('success','Data berhasil ditambahkan.'); }
 public function show(User $user){ $this->allowed($user); return view('users.show',compact('user')); }
 public function edit(User $user){ $this->allowed($user); return view('users.form',['user'=>$user,'roles'=>request()->user()->isAdmin()?['admin','petugas','customer']:['petugas','customer']]); }
 public function update(UpdateUserRequest $request, User $user){ $this->allowed($user); $user->fill($request->safe()->except('password')); if($request->filled('password')) $user->password=Hash::make($request->password); $user->save(); return redirect()->route('users.index')->with('success','Data berhasil diperbarui.'); }
 public function destroy(User $user){ $this->allowed($user); abort_if($user->isAdmin() && User::where('role','admin')->count() <= 1, 422, 'Admin terakhir tidak dapat dihapus.'); abort_if($user->id===request()->user()->id,422,'Anda tidak dapat menghapus akun sendiri.'); abort_if($user->pengaduans()->exists(),422,'User yang memiliki pengaduan tidak dapat dihapus.'); $user->delete(); return redirect()->route('users.index')->with('success','Data berhasil dihapus.'); }
}
