<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Role;
use App\Role_user;
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
    $usuarios = User::with('roles','role_user:id,role_id,user_id')->get();
    // dd($usuarios);
    return view('usuarios.index', compact('usuarios'));
  }

  public function create()
  {
    $roles = Role::pluck('name','id');
    return view('usuarios.create', compact('roles'));
  }

  public function store(Request $request)
  {
    $validar = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    $user
    ->roles()
    ->attach(Role::where('name', 'user')->first());

    $rol = Role_user::create([
      'role_id' => 3,
      'user_id' => $user->id
    ]);
    alert()->success('Operacion exitosa','Usuario creado')->autoclose('5000');
    return redirect('usuarios');

  }

  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

  public function destroy(User $user, $id)
  {
    $usuario = User::findOrFail($id);
    $usuario->delete();
    alert()->success('Operación exitosa', 'Registro eliminado')->autoclose(2000);
    return redirect('usuarios');
  }
}
