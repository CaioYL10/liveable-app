<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            'phone' => 'string',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if ($request->hasFile('profile_picture')){
            $image = $request->file('profile_picture');
            $name = $request->name . '_' . $image->getClientOriginalName() . '.png';
            $profile_picture = $image->storeAs('assets/images/users', $name, 'public');
        }
        $data = array_merge($request->only('name', 'last_name', 'email', 'role', 'phone'), ['password' => Hash::make($request->password)]   );
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

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Dados Incorretos'], 401);
        }

        $token = $user->createToken('access-token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function show(User $user)
    {
        $user = User::findOrFail($user->id);
        return response()->json($user);
    }

    public function listUsers(User $user)
    {
        $users = User::all();
        return response()->json($users);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'phone' => 'required|string',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('profile_picture');
        if (Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        $name = $request->name . '_' . $image->getClientOriginalName() . '.png';
        $profile_picture = $image->storeAs('assets/images/users', $name, 'public');
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $data = array_merge($request->only('name', 'last_name', 'email', 'is_admin', 'telephone'), ['password' => Hash::make($request->password), 'profile_picture' => $profile_picture]);

        if ($user->update($data)) {
            return response()->json(['message' => 'Usuário atualizado'], 200);
        }
        return response()->json(['message' => 'Não foi possivel atualizar o usuário'], 401);

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado'], 200);
    }

    public function myProperties(Request $request)
    {
        $user = $request->user();

        $properties = Property::where('user_id', $user->id)->get();

        return response()->json($properties);
    }
}
