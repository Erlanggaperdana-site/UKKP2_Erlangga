<?php
namespace App\Http\Controllers;
use App\Models\Pengaduan; use App\Models\User;
class DashboardController extends Controller {
 public function __invoke(){ $user=request()->user(); if($user->isCustomer()) return view('dashboard.customer',['total'=>Pengaduan::where('user_id',$user->id)->count(),'pengaduans'=>Pengaduan::where('user_id',$user->id)->latest()->take(5)->get()]); $stats=['pengaduans'=>Pengaduan::count(),'customers'=>User::where('role','customer')->count(),'users'=>User::count(),'admins'=>User::where('role','admin')->count(),'petugas'=>User::where('role','petugas')->count()]; return view($user->isAdmin()?'dashboard.admin':'dashboard.petugas',compact('stats')+['pengaduans'=>Pengaduan::with('user')->latest()->take(5)->get(),'users'=>User::latest()->take(5)->get()]); }
}
