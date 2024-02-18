<?php

namespace App\Http\Controllers;

// use Illuminate\Foundation\Auth\User;
use App\Mail\AvisoFinInscripcionLlamadoJefeCatedra;
use App\Models\Llamado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $users = User::all();
        return view('Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$roles = Role::all();
        $roles = Role::where('name', 'admin')->orWhere('name', 'jefe_catedra')->get();
        return view('Users.create_user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            // Validar los datos del formulario
            $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'rol' => 'required|exists:roles,id', // Validar existencia del rol
            ],
            [
                'name.required' => 'El nombre es obligatorio.',
                'last_name.required' => 'El apellido es obligatorio.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.unique' => 'El correo electrónico ya esta siendo utilizado.',
                'email.email' => 'El correo electrónico no es válido.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.min' => 'La contraseña debe ser de por lo menos 8 caracteres.',
                'password.confirmed' => 'La contraseña no coincide con la confirmación.',
                'rol.required' => 'El rol es obligatorio.',
                'rol.exists' => 'El rol seleccionado no es válido.',
            ]);
                    
    
            // Crear un nuevo usuario
            $user = User::create([
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
    
            // Asigno rol con Spatie
            $role = Role::findOrFail($request->input('rol'));
            $user->assignRole($role->name);
            
            
             // Creo la response 
            $response = response()->json(['data' => $user, 'message' => ['Usuario creado exitosamente'], 'status'=> 201, 'success'=>true]);

            // Redirigir a la vista /users/create
            return redirect('/users/create')->with('response', $response);
            
        }catch(ValidationException $e){
            
            $response = response()->json(['data' => null, 'message' => $e->errors(), 'status'=> 402, 'success'=>false]);
            //return redirect('/users/create')->with('response', $response);
            //NO LO HAGO CON SWEET ALTER PERO SE PORRIA CAMBIAR

            return redirect('/users/create')->withErrors($e->validator)->withInput();
            
        }catch(\Exception $e){
            
            $response = response()->json(['data' => null, 'message' => ['Error interno al crear el usuario ' . $e->getMessage()], 'status'=> 500, 'success'=>false]);
            return redirect('/users/create')->with('response', $response);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::where('name', 'admin')->orWhere('name', 'jefe_catedra')->get();
        return view('Users.create_user', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try{
            $request->validate([
                    'name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email, '.$user->id,
                    'password' => 'required|string|min:8|confirmed',
                    'rol' => 'required|exists:roles,id', // Validar existencia del rol
                ],
                [
                    'name.required' => 'El nombre es obligatorio.',
                    'last_name.required' => 'El apellido es obligatorio.',
                    'email.required' => 'El correo electrónico es obligatorio.',
                    'email.unique' => 'El correo electrónico ya esta siendo utilizado.',
                    'email.email' => 'El correo electrónico no es válido.',
                    'password.required' => 'La contraseña es obligatoria.',
                    'password.min' => 'La contraseña debe ser de por lo menos 8 caracteres.',
                    'password.confirmed' => 'La contraseña no coincide con la confirmación.',
                    'rol.required' => 'El rol es obligatorio.',
                    'rol.exists' => 'El rol seleccionado no es válido.',
                ]);
    
            $user->update($request->all());

            // Creo la response 
            $response = response()->json(['data' => $user, 'message' => ['Usuario editado exitosamente'], 'status'=> 200, 'success'=>true]);

            // Redirigir a la vista /users/create
            return redirect('/users/create')->with('response', $response);
        }catch(ValidationException $e){
            $response = response()->json(['data' => null, 'message' => $e->errors(), 'status'=> 402, 'success'=>false]);
            //return redirect('/users/create')->with('response', $response);
            //NO LO HAGO CON SWEET ALTER PERO SE PORRIA CAMBIAR

            return redirect('/users/create')->withErrors($e->validator)->withInput();
        }catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => ['Error interno al editar el usuario ' . $e->getMessage()], 'status'=> 500, 'success'=>false]);
            return redirect('/users/create')->with('response', $response);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try{
    
            $user->delete();
        
            $response = response()->json(['data' => null, 'message' => ['Usuario eliminado exitosamente'], 'status'=> 204, 'success'=>true]);
            return redirect()->route('users.index')->with('response',$response);
            
        }catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => ['Error al eliminar el usuario: ' . $e->getMessage(),], 'status'=> 500, 'success'=>false]);
            return redirect()->route('users.index')->with('response',$response);
        }
    }

    public function test(String $dest, Llamado $llamado){
        $llam= Llamado::find($llamado)->first();
        // echo $dest;
        // echo $llam;
         Mail::to($dest)->send(new AvisoFinInscripcionLlamadoJefeCatedra($llam));
    }
}
