<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Response;
use App\Repositories\Dashboard\RoleRepository;

class RoleController extends Controller
{
    private $response;
    private $repository;

    public function __construct(
        Response $response,
        RoleRepository $repository
    )
    {
        $this->response = $response;
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *      path="/role",
     *      operationId="RoleIndex",
     *      tags={"Role"},
     * security={
     *  {"bearer": {}},
     *   },
     * summary="Get list of roles",
     * description="Returns list of roles",
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
     *                example={
     *                   "status": true,
     *                   "message": "Data berhasil ditampilkan",
     *                   "data": {
     *                       "current_page": 1,
     *                       "data": {
     *                           {
     *                               "id": 1,
     *                               "name": "Superadmin",
     *                               "guard_name": "api",
     *                               "created_at": "2023-11-01T07:31:40.000000Z",
     *                               "updated_at": "2023-11-01T07:31:40.000000Z"
     *                           }
     *                           },
     *                           "first_page_url": "http://localhost:8001/role?page=1",
     *                           "from": 1,
     *                           "last_page": 58,
     *                           "last_page_url": "http://localhost:8001/role?page=58",
     *                           "links": {
     *                              {
     *                                  "url": null,
     *                                  "label": "&laquo; Previous",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=1",
     *                                  "label": "1",
     *                                  "active": true
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=2",
     *                                  "label": "2",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=3",
     *                                  "label": "3",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=4",
     *                                  "label": "4",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=5",
     *                                  "label": "5",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=6",
     *                                  "label": "6",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=7",
     *                                  "label": "7",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=8",
     *                                  "label": "8",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=9",
     *                                  "label": "9",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=10",
     *                                  "label": "10",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": null,
     *                                  "label": "...",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=57",
     *                                  "label": "57",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=58",
     *                                  "label": "58",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/role?page=2",
     *                                  "label": "Next &raquo;",
     *                                  "active": false
     *                              }
     *                           },
     *                           "next_page_url": "http://localhost:8001/role?page=2",
     *                           "path": "http://localhost:8001/role",
     *                           "per_page": "1",
     *                           "prev_page_url": null,
     *                           "to": 1,
     *                           "total": 58
     *                       }
     *                   }
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
     *      path="/role/{id}",
     *      operationId="RoleShow",
     *      tags={"Role"},
     * security={
     *    {"bearer": {}},
     * },
     * summary="Get role by ID",
     * description="Returns role by ID",
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
     *                example={
     *                    "status": true,
     *                    "token_type": "Single Data berhasil ditampilkan",
     *                    "data": {
     *                       "name": "Superadmin",
     *                       "guard_name": "api",
     *                       "updated_at": "2023-11-02T04:45:12.000000Z",
     *                       "created_at": "2023-11-02T04:45:12.000000Z",
     *                       "id": 103
     *                   }
     *               }
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
     *      path="/role",
     *      operationId="RoleStore",
     *      tags={"Role"},
     * security={
     *  {"bearer": {}},
     *   },
     *      summary="Insert role",
     *      description="Create role",
     * 
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *       @OA\Response(
     *          response=200,
     *           description="Success",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *               @OA\Schema(
     *                    example={
     *                        "status": true,
     *                        "token_type": "Single Data berhasil ditambah",
     *                        "data": {
     *                           "name": "Name",
     *                           "guard_name": "api",
     *                           "updated_at": "2023-11-02T04:45:12.000000Z",
     *                           "created_at": "2023-11-02T04:45:12.000000Z",
     *                           "id": 103
     *                       }
     *                   }
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
     *      path="/role/{id}",
     *      operationId="RoleUpdate",
     *      tags={"Role"},
     * security={
     *  {"bearer": {}},
     *   },
     * summary="Update Role by ID",
     * description="Update role by ID",
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
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": true,
     *                    "token_type": "Data berhasil diupdate",
     *                    "data": 1
     *                }
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
     *      path="/role/{id}",
     *      operationId="RoleDelete",
     *      tags={"Role"},
     * security={
     *  {"bearer": {}},
     *   },
     *  summary="Delete role by ID",
     *  description="Delete role by ID",
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
     *                example={
     *                    "status": true,
     *                    "token_type": "Data berhasil dihapus",
     *                    "data": true
     *                }
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