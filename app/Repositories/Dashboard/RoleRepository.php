<?php

namespace App\Repositories\Dashboard;

use Illuminate\Support\Facades\Validator;
use App\Traits\Response;
use Spatie\Permission\Models\Role;

class RoleRepository
{

    private $response;
    private $role;

    public function __construct(
        Response $response,
        Role $role
    )
    {
        $this->response = $response;
        $this->role = $role;
    }

    public function index($request){
        $data = $this->role->orderBy('id', ($request['sort']) ? $request['sort'] : 'desc')->where(function($q) use ($request){
            $q->orWhere('name', 'like', '%'.$request['search'].'%');
        })->paginate(($request['limit']) ? $request['limit'] : 10);

        return $this->response->index($data);
    }

    public function show($id){
        $data = $this->role->find($id);
        $returned = null;
        ($data) ? $returned = $this->response->show($data) : $returned = $this->response->notFound();
        return $returned;
    }

    public function store($request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validation->fails()){
            return $this->response->validationError($validation->errors());
        } else {
            $data = $this->role->create([
                'name' => $request['name'],
                'guard_name' => 'api'
            ]);
            
            $returned = null;
            ($data) ? $returned = $this->response->store($data) : $returned = $this->response->storeError();
            return $returned;
        }
    }

    public function update($id, $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validation->fails()){
            return $this->response->validationError($validation->errors());
        } else {
            $data = $this->role->where('id', $id)->update([
                'name' => $request['name'],
                'guard_name' => 'api'
            ]);
            
            $returned = null;
            ($data) ? $returned = $this->response->update($data) : $returned = $this->response->updateError();
            return $returned;
        }
    }

    public function destroy($id){
        $check = $this->role->find($id);
        if($check){
            $data = $this->role->find($id)->delete();
            $returned = null;
            ($data) ? $returned = $this->response->destroy($data) : $returned = $this->response->destroyError();
            return $returned;
        } else {
            return $this->response->notFound();
        }
    }
}