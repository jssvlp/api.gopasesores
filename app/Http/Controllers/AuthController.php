<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->status = 'Activo';
        $user->password = bcrypt($request->password);

        $user->save();

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        if( !$request->email && !$request->username )
        {
            return response()->json(['success'=> false, 'message' => 'Usuario o contraseña incorrecto']);
        }
        $credentials = $request->only(['email', 'password']);
        $userOrEmail = ($request->username ? $request->username : $request->email);
        $user = $this->userRepository->findByUsernameOrEmail($userOrEmail );

        $credentials['email'] = $user->email;

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['success'=> false, 'error' => 'Usuario o contraseña incorrecto']);
        }

        $permisions = $this->userRepository->getPermissions($user);
        $roles = $user->getRoleNames();

        return $this->respondWithToken($token,$permisions,$roles,$user);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['success' =>true,'message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @param $permissions
     * @param $roles
     * @return JsonResponse
     */
    protected function respondWithToken($token,$permissions,$roles,$user)
    {
        unset($user['roles']);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user_data' => $user,
            'expires_in' => auth()->factory()->getTTL() * 60,
            'permissions' => $permissions,
            'roles' => $roles
        ]);
    }

}
