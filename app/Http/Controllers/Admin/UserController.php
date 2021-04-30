<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Leer Usuario')->only('index','show');
        $this->middleware('can:Crear Usuario')->only('create', 'store');
        $this->middleware('can:Editar Usuario')->only('edit', 'update');
        $this->middleware('can:Eliminar Usuario')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::class;
        return view('admin.users.index', compact('user'));
    }

    public function profile(){
        $user = User::select('users.*', 'nodes.descripcion AS descripcionNodo')
                ->leftJoin('nodes', 'nodes.id', '=', 'users.idNode')
                ->find(Auth::user()->id);

        return view('admin.profiles.index', compact('user'));
    }

    public function updateProfile(Request $request, User $user){

        $request->validate([
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'checkNewPassword' => 'required|min:6',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $hashedPassword)){
            if(!Hash::check($request->newPassword, $hashedPassword)){
                if($request->newPassword === $request->checkNewPassword){
                    
                    session()->flash('success','¡La contraseña se actualizo correctamente!');
                    User::where('id', '=', Auth::user()->id)->update(['password' => Hash::make($request->newPassword)]);
                    return redirect()->back();
                } else {
                    session()->flash('info','¡La nueva contraseña no coincide con el verificador de contraseña!');
                    return redirect()->back();
                }
            } else {
                session()->flash('info','¡La nueva contraseña no puede ser igual a la antigua!');
                return redirect()->back();
            }
        } else {
            session()->flash('info','¡La contraseña antigua no coincide!');
            return redirect()->back();
        }
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $nodes = Node::pluck('descripcion','id');
        return view('admin.users.create', compact('roles','nodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'idNode' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'dni' => 'required|min:8|max:8|regex:/^[0-9]*$/|unique:users,dni',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'idNode' => $request->idNode,
            'name' => $request->name,
            'email' => $request->email,
            'dni' => $request->dni,
            'password' => Hash::make($request->password)
        ]);
        
        $user->roles()->attach($request->roles);
        return redirect()->route('admin.users.index')->with('info', $user->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $nodes = Node::pluck('descripcion','id');
        return view('admin.users.edit', compact('user','roles','nodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'idNode' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'dni' => 'required|min:8|max:8|regex:/^[0-9]*$/|unique:users,dni,' . $user->id,
        ]);

        $update = [
            'idNode' => $request->idNode,
            'name' => $request->name,
            'emai' => $request->email,
            'dni' => $request->dni,
        ];

        $pass = ($request->password != '' ? [
            'password' => Hash::make($request->password), 
        ] : [

        ]);

        $data = array_merge($update,$pass);

        $user->update($data);

        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.edit',$user)->with('info',$user->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUser)
    {
        User::find($idUser)->delete();
    }
}
