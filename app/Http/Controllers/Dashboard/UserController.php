<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Response;
use App\Repositories\Dashboard\UserRepository;

class UserController extends Controller
{
    private $response;
    private $repository;

    public function __construct(
        Response $response,
        UserRepository $repository
    )
    {
        $this->response = $response;
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *      path="/user",
     *      operationId="UserIndex",
     *      tags={"User"},
     * security={
     *  {"bearer": {}},
     *   },
     * summary="Get list of users",
     * description="Returns list of users",
     * 
     * @OA\Parameter(
     *      name="search",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *  ),
     *  @OA\Parameter(
     *      name="sort",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *  ),
     *  @OA\Parameter(
     *      name="limit",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *        type="string"
     *      )
     *  ),
     *     @OA\Response(
     *        response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                example={"status":true,"message":"Data berhasil ditampilkan","data":{"current_page":1,"data":{{"id":202,"name":"Inactive","email":"inactive100@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":202,"role_id":4,"model_type":"App\\Models\\User"}}}},{"id":201,"name":"Inactive","email":"inactive99@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":201,"role_id":4,"model_type":"App\\Models\\User"}}}},{"id":200,"name":"Inactive","email":"inactive98@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":200,"role_id":4,"model_type":"App\\Models\\User"}}}},{"id":199,"name":"Inactive","email":"inactive97@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":199,"role_id":4,"model_type":"App\\Models\\User"}}}},{"id":198,"name":"Inactive","email":"inactive96@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":198,"role_id":4,"model_type":"App\\Models\\User"}}}},{"id":197,"name":"Inactive","email":"inactive95@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":197,"role_id":4,"model_type":"App\\Models\\User"}}}},{"id":196,"name":"Inactive","email":"inactive94@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":196,"role_id":4,"model_type":"App\\Models\\User"}}}},{"id":195,"name":"Inactive","email":"inactive93@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":195,"role_id":4,"model_type":"App\\Models\\User"}}}},{"id":194,"name":"Inactive","email":"inactive92@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":194,"role_id":4,"model_type":"App\\Models\\User"}}}},{"id":193,"name":"Inactive","email":"inactive91@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:46.000000Z","updated_at":"2024-05-31T07:40:46.000000Z","roles":{{"id":4,"name":"Inactive","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":193,"role_id":4,"model_type":"App\\Models\\User"}}}}},"first_page_url":"http://localhost:8000/user?page=1","from":1,"last_page":21,"last_page_url":"http://localhost:8000/user?page=21","links":{{"url":null,"label":"pagination.previous","active":false},{"url":"http://localhost:8000/user?page=1","label":"1","active":true},{"url":"http://localhost:8000/user?page=2","label":"2","active":false},{"url":"http://localhost:8000/user?page=3","label":"3","active":false},{"url":"http://localhost:8000/user?page=4","label":"4","active":false},{"url":"http://localhost:8000/user?page=5","label":"5","active":false},{"url":"http://localhost:8000/user?page=6","label":"6","active":false},{"url":"http://localhost:8000/user?page=7","label":"7","active":false},{"url":"http://localhost:8000/user?page=8","label":"8","active":false},{"url":"http://localhost:8000/user?page=9","label":"9","active":false},{"url":"http://localhost:8000/user?page=10","label":"10","active":false},{"url":null,"label":"...","active":false},{"url":"http://localhost:8000/user?page=20","label":"20","active":false},{"url":"http://localhost:8000/user?page=21","label":"21","active":false},{"url":"http://localhost:8000/user?page=2","label":"pagination.next","active":false}},"next_page_url":"http://localhost:8000/user?page=2","path":"http://localhost:8000/user","per_page":10,"prev_page_url":null,"to":10,"total":202}}
     *             )
     *         )
     *      ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Bad Request | Validation Error Message",
     *                    "data": null
     *                }
     *           )
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauntheticated",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Token Invalid/Kadaluarsa",
     *                    "data": null
     *                }
     *           )
     *      )
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Internal Error",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Internal Error",
     *                    "data": {"messages": {}}
     *                }
     *           )
     *      )
     *   )
     * ),
     * )
     */
    public function index(Request $request){
        try {
            return $this->repository->index($request);
        } catch (\Exception $th) {
            return $this->response->error($th->getMessage());
        }
    }

    /**
     * @OA\Get(
     *      path="/user/{id}",
     *      operationId="UserShow",
     *      tags={"User"},
     * security={
     *    {"bearer": {}},
     * },
     * summary="Get user by ID",
     * description="Returns user by ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *         type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *                example={"status":true,"message":"Single Data berhasil ditampilkan","data":{"id":1,"name":"Superadmin","email":"superadmin@gmail.com","last_logged_in":null,"created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","roles":{{"id":1,"name":"Superadmin","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":1,"role_id":1,"model_type":"App\\Models\\User"}}}}}
     *          )
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Bad Request | Validation Error Message",
     *                    "data": null
     *                }
     *           )
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauntheticated",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Token Invalid/Kadaluarsa",
     *                    "data": null
     *                }
     *           )
     *      )
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not Found",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Data tidak ditemukan",
     *                    "data": null
     *                }
     *           )
     *      )
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Internal Error",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Internal Error",
     *                    "data": {"messages": {}}
     *                }
     *           )
     *      )
     *    )
     *  ),
     * )
     */
    public function show($id){
        try {
            return $this->repository->show($id);
        } catch (\Exception $th) {
            return $this->response->error($th->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/user",
     *      operationId="UserStore",
     *      tags={"User"},
     * security={
     *  {"bearer": {}},
     *   },
     *      summary="Insert user",
     *      description="Create user",
     * 
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *        type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *        type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="role_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *        type="integer"
     *      )
     *   ),
     *       @OA\Response(
     *          response=200,
     *           description="Success",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *               @OA\Schema(
     *                    example={"status":true,"message":"Data berhasil ditambah","data":{"name":"okeh","email":"okeh@gmail.com","updated_at":"2024-05-31T08:05:39.000000Z","created_at":"2024-05-31T08:05:39.000000Z","id":203,"roles":{{"id":2,"name":"Admin","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":203,"role_id":2,"model_type":"App\\Models\\User"}}}}}
     *              )
     *          )
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\MediaType(
     *          mediaType="application/json",
     *               @OA\Schema(
     *                    example={
     *                        "status": false,
     *                        "message": "Bad Request | Validation Error Message",
     *                        "data": null
     *                    }
     *               )
     *          )
     *       ),
     *       @OA\Response(
     *          response=401,
     *          description="Unauntheticated",
     *          @OA\MediaType(
     *          mediaType="application/json",
     *               @OA\Schema(
     *                    example={
     *                        "status": false,
     *                        "message": "Unauntheticated",
     *                        "data": {}
     *                    }
     *               )
     *          )
     *       ),
     *       @OA\Response(
     *          response=500,
     *          description="Internal Error",
     *          @OA\MediaType(
     *          mediaType="application/json",
     *               @OA\Schema(
     *                    example={
     *                        "status": false,
     *                        "message": "Internal Error",
     *                        "data": {"messages": {}}
     *                    }
     *               )
     *          )
     *       )
     *   ),
     * )
     */
    public function store(Request $request){
        try {
            return $this->repository->store($request);
        } catch (\Exception $th) {
            return $this->response->error($th->getMessage());
        }
    }

    /**
     * @OA\Put(
     *      path="/user/{id}",
     *      operationId="UserUpdate",
     *      tags={"User"},
     * security={
     *  {"bearer": {}},
     *   },
     * summary="Update User by ID",
     * description="Update user by ID",
     * 
     * @OA\Parameter(
     *   name="id",
     *   in="path",
     *   required=true,
     *   @OA\Schema(
     *       type="integer"
     *   )
     * ),
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *        type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *        type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="role_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *        type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *                example={"status":true,"message":"Data berhasil diedit","data":{"id":203,"name":"Oke","email":"okejeh@gmail.com","last_logged_in":null,"created_at":"2024-05-31T08:05:39.000000Z","updated_at":"2024-05-31T08:09:55.000000Z","roles":{{"id":3,"name":"User","guard_name":"api","created_at":"2024-05-31T07:40:36.000000Z","updated_at":"2024-05-31T07:40:36.000000Z","pivot":{"model_id":203,"role_id":3,"model_type":"App\\Models\\User"}}}}}
     *          )
     *      )
     *   ),
     *   @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\MediaType(
     *          mediaType="application/json",
     *               @OA\Schema(
     *                    example={
     *                        "status": false,
     *                        "message": "Bad Request | Validation Error Message",
     *                        "data": null
     *                    }
     *               )
     *          )
     *    ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauntheticated",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Token Invalid/Kadaluarsa",
     *                    "data": null
     *                }
     *           )
     *      )
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not Found",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Data tidak ditemukan",
     *                    "data": null
     *                }
     *           )
     *      )
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Internal Error",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Internal Error",
     *                    "data": {"messages": {}}
     *                }
     *           )
     *      )
     *   ),
     * )
     */
    public function update($id, Request $request){
        try {
            return $this->repository->update($id, $request);
        } catch (\Exception $th) {
            return $this->response->error($th->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *      path="/user/{id}",
     *      operationId="UserDelete",
     *      tags={"User"},
     * security={
     *  {"bearer": {}},
     *   },
     *  summary="Delete user by ID",
     *  description="Delete user by ID",
     *  @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *         type="integer"
     *     )
     *  ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *                example={"status":true,"message":"Data berhasil dihapus","data":true}
     *          )
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauntheticated",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Token Invalid/Kadaluarsa",
     *                    "data": null
     *                }
     *           )
     *      )
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not Found",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Data tidak ditemukan",
     *                    "data": null
     *                }
     *           )
     *      )
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Internal Error",
     *      @OA\MediaType(
     *      mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": false,
     *                    "message": "Internal Error",
     *                    "data": {"messages": {}}
     *                }
     *           )
     *      )
     *   )
     * )
     */
    public function destroy($id){
        try {
            return $this->repository->destroy($id);
        } catch (\Exception $th) {
            return $this->response->error($th->getMessage());
        }
    }
}