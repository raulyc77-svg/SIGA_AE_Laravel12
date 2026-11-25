<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
 public function form(){return view('auth.login');}
 public function login(Request $r){
  $d=$r->validate(['username'=>'required|string','password'=>'required|string']);
  if(Auth::attempt(['username'=>$d['username'],'password'=>$d['password'],'activo'=>1],$r->boolean('recordar'))){
   $r->session()->regenerate(); $u=Auth::user(); $u->forceFill(['ultimo_acceso'=>now()])->save();
   if($u->primer_inicio) return redirect()->route('perfil.password');
   return redirect()->route('dashboard');
  }
  return back()->withErrors(['username'=>'Usuario o contraseña incorrectos.'])->onlyInput('username');
 }
 public function logout(Request $r){Auth::logout();$r->session()->invalidate();$r->session()->regenerateToken();return redirect()->route('login');}
 public function passwordForm(){return view('auth.password');}
 public function passwordUpdate(Request $r){$d=$r->validate(['password'=>'required|string|min:8|confirmed']);$u=$r->user();$u->password=bcrypt($d['password']);$u->primer_inicio=false;$u->save();return redirect()->route('dashboard')->with('ok','Contraseña actualizada.');}
}
