<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Response;
use App\Repositories\Dashboard\ContactRepository;

class ContactController extends Controller
{
    private $response;
    private $repository;

    public function __construct(
        Response $response,
        ContactRepository $repository
    )
    {
        $this->response = $response;
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *      path="/contact",
     *      operationId="ContactIndex",
     *      tags={"Contact"},
     * security={
     *  {"bearer": {}},
     *   },
     * summary="Get list of contacts",
     * description="Returns list of contacts",
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
     *                               "type": "Telp",
     *                               "name": "Jayeng Saragih",
     *                               "contact": "0949 1989 871",
     *                               "created_at": "2023-11-01T07:31:40.000000Z",
     *                               "updated_at": "2023-11-01T07:31:40.000000Z"
     *                           }
     *                           },
     *                           "first_page_url": "http://localhost:8001/contact?page=1",
     *                           "from": 1,
     *                           "last_page": 58,
     *                           "last_page_url": "http://localhost:8001/contact?page=58",
     *                           "links": {
     *                              {
     *                                  "url": null,
     *                                  "label": "&laquo; Previous",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=1",
     *                                  "label": "1",
     *                                  "active": true
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=2",
     *                                  "label": "2",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=3",
     *                                  "label": "3",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=4",
     *                                  "label": "4",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=5",
     *                                  "label": "5",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=6",
     *                                  "label": "6",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=7",
     *                                  "label": "7",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=8",
     *                                  "label": "8",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=9",
     *                                  "label": "9",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=10",
     *                                  "label": "10",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": null,
     *                                  "label": "...",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=57",
     *                                  "label": "57",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=58",
     *                                  "label": "58",
     *                                  "active": false
     *                              },
     *                              {
     *                                  "url": "http://localhost:8001/contact?page=2",
     *                                  "label": "Next &raquo;",
     *                                  "active": false
     *                              }
     *                           },
     *                           "next_page_url": "http://localhost:8001/contact?page=2",
     *                           "path": "http://localhost:8001/contact",
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
     *      path="/contact/{id}",
     *      operationId="ContactShow",
     *      tags={"Contact"},
     * security={
     *    {"bearer": {}},
     * },
     * summary="Get contact by ID",
     * description="Returns contact by ID",
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
     *                       "type": "Oke",
     *                       "name": "Name",
     *                       "contact": "Contact",
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
     *      path="/contact",
     *      operationId="ContactStore",
     *      tags={"Contact"},
     * security={
     *  {"bearer": {}},
     *   },
     *      summary="Insert contact",
     *      description="Create contact",
     * 
     *   @OA\Parameter(
     *      name="type",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="contact",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *        type="string"
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
     *                           "type": "Oke",
     *                           "name": "Name",
     *                           "contact": "Contact",
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
     *      path="/contact/{id}",
     *      operationId="ContactUpdate",
     *      tags={"Contact"},
     * security={
     *  {"bearer": {}},
     *   },
     * summary="Update Contact by ID",
     * description="Update contact by ID",
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
     *      name="type",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="contact",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *        type="string"
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
     *      path="/contact/{id}",
     *      operationId="ContactDelete",
     *      tags={"Contact"},
     * security={
     *  {"bearer": {}},
     *   },
     *  summary="Delete contact by ID",
     *  description="Delete contact by ID",
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