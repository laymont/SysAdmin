<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use Alert;


class UserController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
  public function __construct()
  {
    $this->middleware('auth:web');
  }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
  {
    if(Auth::user()->hasRole('user')){
      alert()->error('No esta Autorizado','ERROR 401')->autoclose(2000);
      return view('home');
    }
    $usuarios = User::with('roles')->get();
    return view('usuarios.index', compact('usuarios'));
  }

  public function destroy(User $user, $id)
  {
    $usuario = User::findOrFail($id);
    $usuario->delete();
    alert()->success('Operación exitosa', 'Registro eliminado')->autoclose(2000);
    return redirect('usuarios');
  }
}
