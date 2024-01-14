<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
      //  dd(auth()->attempt($credentials));
        if (! $token = auth()->attempt($credentials)) {
            // dd($token);
            return response()->json(['error' => 'Unauthorized','data'=>$token], 401);
        }

        return $this->respondWithToken($token);
    }

    
    public function register(Request $request){
        // return response()->json([
        //     'message'=>'Masuk ndroo',
        // ]);
        // exit();
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => app('hash')->make($request->input('password')),
            'role'=>$request->input('role'),
            'mahasiswa_id'=>$request->input('mahasiswa_id'),
            'dosen_id'=>$request->input('dosen_id')
        ]);
       // dd($user);
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Registrasi Berhasil Disimpan!',
                'data' => $user
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Registrasi Gagal Disimpan!',
            ], 400);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user'    => auth()->guard('api')->user(), 
            'token_type' => 'bearer',
         //   'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}