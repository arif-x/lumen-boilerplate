<?php

namespace App\Repositories\Dashboard;

use Illuminate\Support\Facades\Validator;
use App\Traits\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    private $response;
    private $role;
    private $permission;

    public function __construct(
        Response $response,
        Role $role,
        Permission $permission
    ) {
        $this->response = $response;
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $data = $this->permission->get();
        return $this->response->index($data);
    }

    public function sync($id, $request)
    {
        $validation = Validator::make($request->all(), [
            'permissions' => 'required',
        ]);

        if($validation->fails()){
            return $this->response->validationError($validation->errors());
        }

        $data = $this->role::find($id);
        $data->syncPermissions($request['permissions']);

        return response()->json(["status" => true, "message" => "Role synced succesfully."]);
    }
}
