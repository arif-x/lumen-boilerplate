<?php

namespace App\Repositories\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\Response;
use App\Models\User;

class AuthRepository {
    
    private $response;
    private $user;

    public function __construct(
        Response $response,
        User $user
    )
    {
        $this->response = $response;
        $this->user = $user;   
    }

    public function register($request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validation->fails()){
            return $this->response->validationError($validation->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        if ($user) {
            $data['token'] =  $user->createToken('MyApp')->accessToken;
            $data['user'] =  $user;
            $user->syncRoles(['Inactive']);
    
            return $this->response->register($data);
        } else {
            return $this->response->registerError($user);
        }
    }

    public function login($request) {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validation->fails()){
            return $this->response->validationError($validation->errors());
        }

        $auth = User::where('email', $request->email)->first();
        if($auth){ 
            if (Hash::check($request->input('password'), $auth->password)) {
                $data['token'] =  $auth->createToken('MyApp')->accessToken; 
                $data['user'] =  $auth;
                return response()->json($data);
            } else {
                return $this->response->loginError();
            }
        } else{ 
            return $this->response->loginError();
        } 
    }
}
