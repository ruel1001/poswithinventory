<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\API\RestTrait;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use function PHPUnit\Framework\throwException;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthController extends Controller
{
    use RestTrait;

    /**
     * token
     *
     * @var string
     */
    private $token = '';

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->token = config('auth.sanctum_token');
    }

    /**
     * User Register
     *
     * @param  RegisterRequest $request
     * @param  User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request, User $user)
    {
        try {
            // get validated request data
            $requestData = $request->validated();

            $user = $user->create([
                'uuid' => Str::orderedUuid(),
                'user_name' => $requestData['user_name'],
                'email' => $requestData['email'],
                'address' => $requestData['address'],
                'user_type' => $requestData['user_type'],
                'username ' => $requestData['username'],
                'password' => bcrypt($requestData['password']),
            ]);

            if ($request->get('role') === 'admin') {
                $user->assignRole('admin');
            } else {
                $user->assignRole('customer');
            }
            
            $tokenName = $this->token ?? 'default_token';

            $data = [
                'user' => $user,
                'token' => $user->createToken($tokenName)->plainTextToken
    
            ];
            return $this->successResponse($data, 'User Created Successfully', Response::HTTP_CREATED);
        } catch (HttpResponseException $e) {
            throwException($e);
        }
    }

    /**
     * User Login
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        // get validated request data
        $requestData = $request->validated();

        try {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return $this->errorResponse('Invalid account credentials.', Response::HTTP_UNAUTHORIZED);
            }

            $user = User::where('email', $requestData['email'])->first();
            $data = [
                'user' => $user,
                'token' => $user->createToken($this->token)->plainTextToken
            ];
            return $this->successResponse($data, 'User Logged In Successfully', Response::HTTP_OK);
        } catch (HttpResponseException $e) {
            throwException($e);
        }
    }

    /**
     * User Logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (auth()->user()->tokens()->delete()) {
            return $this->successResponse([], 'User Logged Out Successfully', Response::HTTP_OK);
        }
    }
}
