<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Dashboard\PermissionRepository;
use App\Traits\Response;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $response;
    private $repository;

    public function __construct(
        Response $response,
        PermissionRepository $repository
    ) {
        $this->response = $response;
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *      path="/permission",
     *      operationId="PermissionIndex",
     *      tags={"Permission"},
     * security={
     *  {"bearer": {}},
     *   },
     * summary="Get list of permissions",
     * description="Returns list of permissions",
     * 
     *     @OA\Response(
     *        response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                example={"status":true,"message":"Data berhasil ditampilkan","data":{{"id":1,"name":"role-index","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":2,"name":"role-store","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":3,"name":"role-update","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":4,"name":"role-destroy","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":5,"name":"user-index","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":6,"name":"user-store","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":7,"name":"user-update","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":8,"name":"user-destroy","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":9,"name":"contact-index","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":10,"name":"contact-store","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":11,"name":"contact-update","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"},{"id":12,"name":"contact-destroy","guard_name":"api","created_at":"2024-05-31T08:23:31.000000Z","updated_at":"2024-05-31T08:23:31.000000Z"}}}
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
    public function index()
    {
        try {
            return $this->repository->index();
        } catch (\Exception $th) {
            return $this->response->error($th->getMessage());
        }
    }

    /**
     * @OA\Put(
     *      path="/permission/{id}/sync",
     *      operationId="PermissionSyncer",
     *      tags={"Permission"},
     * security={
     *  {"bearer": {}},
     *   },
     * summary="Sync Permission by Role ID",
     * description="Sync permission by Role ID",
     * 
     * @OA\Parameter(
     *   name="id",
     *   in="path",
     *   required=true,
     *   @OA\Schema(
     *       type="integer"
     *   )
     * ),
     *     @OA\Parameter(
     *         name="permissions[]",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                 type="string"
     *             )
     *         ),
     *         style="form",
     *         explode=true,
     *         description="Array of permission"
     *     ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *                example={"status":true,"message":"Role synced succesfully."}
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
     *                          "status": false,
     *                          "message": "Bad Request | Validation Error Message",
     *                          "data": null
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
    public function sync($id, Request $request) {
        try {
            return $this->repository->sync($id, $request);
        } catch (\Exception $th) {
            return $this->response->error($th->getMessage());
        }
    }
}
