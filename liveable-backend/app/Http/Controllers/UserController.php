<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'profile_picture' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $data = array_merge($request->only('name', 'last_name', 'email', 'profile_picture'), ['password' => Hash::make($request->password)]);
        if (User::create($data)) {
            return response()->json(['message' => 'Usuario registrado'], 201);
        }
        return response()->json(['message' => 'Error ao registrar usuário'], 500);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();
            return response()->json(['message' => 'Usuário autenticado.'], 200);
        }
        return response()->json(['message' => 'Dados Incorretos'], 401);
    }
    public function show(User $users)
    {
        $user = User::findOrFail($users->id);
        return response()->json($user);
    }
    public function listUsers(User $user)
    {
        $users = User::all();
        return response()->json($users);
    }
    public function update(Request $request, User $users)
    {
        $data = $request->validate([
            'name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required'],
            'profile_picture' => ['required'],
            'is_admin' => ['boolean'],
        ]);

        if ($users->update($data)){
            return response()->json(['message' => 'Usuário atualizado'], 200);
        }
        return response()->json(['message' => 'Não foi possivel atualizar o usuário'], 401);

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logout realizado'], 200);
    }
}
