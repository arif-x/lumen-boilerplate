<?php

namespace App\Repositories\Dashboard;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Traits\Response;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRepository
{

    private $response;
    private $user;
    private $role;

    public function __construct(
        Response $response,
        User $user,
        Role $role
    )
    {
        $this->response = $response;
        $this->user = $user;
        $this->role = $role;
    }

    public function index($request){
        $data = $this->user->with('roles')->orderBy('id', ($request['sort']) ? $request['sort'] : 'desc')->where(function($q) use ($request){
            $q->orWhere('name', 'like', '%'.$request['search'].'%')
            ->orWhere('email', 'like', '%'.$request['search'].'%');
        })->paginate(($request['limit']) ? $request['limit'] : 10);

        return $this->response->index($data);
    }

    public function show($id){
        $data = $this->user->with('roles')->find($id);
        $returned = null;
        ($data) ? $returned = $this->response->show($data) : $returned = $this->response->notFound();
        return $returned;
    }

    public function store($request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validation->fails()){
            return $this->response->validationError($validation->errors());
        } else {
            $data = $this->user->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $role = $this->role->where('id', $request['role_id'])->first();
            if ($role) {
                $data->syncRoles([$role->name]);
            }
            
            $returned = null;
            ($data) ? $returned = $this->response->store($data) : $returned = $this->response->storeError();
            return $returned;
        }
    }

    public function update($id, $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if($validation->fails()){
            return $this->response->validationError($validation->errors());
        } else {
            $data = [];
            if ($request['password']) {
                $data = $this->user->where('id', $id)->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);
            } else {
                $data = $this->user->where('id', $id)->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                ]);
            }

            $data = $this->user->where('id', $id)->first();
            $role = $this->role->where('id', $request['role_id'])->first();
            if ($role) {
                $data->syncRoles([$role->name]);
            }
            
            $returned = null;
            ($data) ? $returned = $this->response->update($data) : $returned = $this->response->updateError();
            return $returned;
        }
    }

    public function destroy($id){
        $check = $this->user->find($id);
        if($check){
            $data = $this->user->find($id)->delete();
            $returned = null;
            ($data) ? $returned = $this->response->destroy($data) : $returned = $this->response->destroyError();
            return $returned;
        } else {
            return $this->response->notFound();
        }
    }
}