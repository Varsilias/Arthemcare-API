<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => [
            'login',
            'register',
            'createRoles',
            'registerAsDoctor',
            'registerAsNurse',
            'registerAsStaff',
            'getUserRoles'

        ]]);
    }


    // public function getUserRoles()
    // {
    //     // $user = new User();
    //     // $user->getRoleNames();
    //     $users = User::with('roles')->get();
    //     foreach ($users as $user) {
    //        return response()->json([
    //             'role' => $user['roles'][0]['name']
    //        ]);
    //     }


    // }

    public function registerAsDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [

        'firstname' => 'required|string|between:2,100',
        'lastname' => 'required|string|between:2,100',
        'speciality' => 'required|string',
        'gender' => 'required|string',
        'DOB' => 'required',
        'username' => 'required|string|between:2,100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|min:6'

      ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge($validator->validated(), [
                        'password' => bcrypt($request->password),
                    ]
                ));

        $user->assignRole('Doctor');
        return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
        ]);
    }

    public function registerAsNurse(Request $request)
    {
        $validator = Validator::make($request->all(), [

        'firstname' => 'required|string|between:2,100',
        'lastname' => 'required|string|between:2,100',
        'gender' => 'required|string',
        'DOB' => 'required',
        'username' => 'required|string|between:2,100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|min:6'

      ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge($validator->validated(), [
                        'password' => bcrypt($request->password),
                    ]
                ));

        $user->assignRole('Nurse');
        return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
        ]);
    }

    public function registerAsStaff(Request $request)
    {
        $validator = Validator::make($request->all(), [

        'firstname' => 'required|string|between:2,100',
        'lastname' => 'required|string|between:2,100',
        'gender' => 'required|string',
        'DOB' => 'required',
        'username' => 'required|string|between:2,100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|min:6'

      ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge($validator->validated(), [
                        'password' => bcrypt($request->password),
                    ]
                ));

        $user->assignRole('FrontDesk Staff');
        return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
        ]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {

        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            'error' => false,
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
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
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user' => $this->guard()->user(),
            'role' => $this->guard()->user()->getRoleNames()
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    public function createRoles()
    {
        Role::create(['name' => 'Doctor']);
        Role::create(['name' => 'Nurse']);
        Role::create(['name' => 'FrontDesk Staff']);
        return 'created Roles';
    }
}
