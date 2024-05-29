<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Auth\AuthRepository;
use App\Traits\Response;

class AuthController extends Controller
{
    private $response;
    private $repository;

    public function __construct(
        Response $response,
        AuthRepository $repository
    ) {
        $this->response = $response;
        $this->repository = $repository;
    }

    /**
     * @OA\Post(
     ** path="/register",
     *   tags={"Auth"},
     *   summary="Register",
     *   operationId="register",
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *                example={
     *                    "status": "true",
     *                    "token_type": "Registrasi Sukses",
     *                    "data": {
     *                        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDE2OWM2M2YxMjdjNzdlMDkwMjVkY2IwMWEwYTQxNDI0ZDRjMTcwMTcyNzU2NWRkNzNmZDQ0Y2FhMWUzY2E0ZTkwODVhNTdiYjk0MTVlYmYiLCJpYXQiOjE2OTg4OTk1NTAuODQ0OTA3LCJuYmYiOjE2OTg4OTk1NTAuODQ0OTEyLCJleHAiOjE3MzA1MjE5NTAuODM1MTIsInN1YiI6IjMiLCJzY29wZXMiOltdfQ.SpVjKDatBvc3xLM1FGQk5Kg1jSR1FRrvNpMjEACBWYUTeRtcG396QtpP6dLaZBJRCA9i0ImX_iyp8mRojM5XgLmSFrB39meiFmEBl_cMxvdhwMLQZR_ewDd1XNI4MAEJ5ir1vKKNTCAAnnJRGqP0gtYoi7G-5TDBMQDKHv-QBh5Fmujvome0bYkQrPCZDhLEGAV1GysFE6-tGECdckvRov-2LlaEvmYgJftZN5RSZU6PhHKdt8Y44Rh_qp5PXbQ_gum792omo80ulkJ1TPaylOBwgSEnbUdK-RgCS63ehpcZag60uguyTpYDaVJQJkoPuCW_ApCisZ9YhOOHNNg-QJCQqQ-D6vJLGrq4cgnxWQLu6lNk00oe2KUTpPkmdIQJtO3742RtCaOCnVoUip3hGGViasaGvqp9W0lfozShmuC3tcfEUmKX8A8-dKBKZwc6Wesy8d-u-ENDu2fnU6qXkXQRRhi-mB_vUzJaOsG7X3Lpa2K5kHRJySvjbu-5FdN6WRybRhfUmvKel1MpIZyAQjpdkzYM0KnTNN22c2DNv9UBqG_0ZkacZvRM3GcJ520dL66uML5XfKjq0_ppSCErLjgzc6tcpvHzNruxFj3RRr7bTYKvR8ZqMCJAVqESvqVItBMJdfpadwGQW8WyLAahUW-6ArVP4kpfQMsk1A3NNCQ",
     *                        "user": {
     *                           "name": "OKE",
     *                           "email": "oke@gmail.com",
     *                           "updated_at": "2023-11-02T04:32:30.000000Z",
     *                           "created_at": "2023-11-02T04:32:30.000000Z",
     *                           "id": 3
     *                        }
     *                     }
     *                }
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
     *)
     **/
    public function register(Request $request)
    {
        try {
            return $this->repository->register($request);
        } catch (\Exception $th) {
            return $this->response->error($th->getMessage());
        }
    }

    /**
     * @OA\Post(
     ** path="/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
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
     *                   "status": true,
     *                   "message": "Login Sukses",
     *                   "data": {
     *                       "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMjRkYzRiNDM3OWE5MTFjOWM3YzA3ODFmOGU5MjIwNWI2ZmQyMmEwYjE2YThlYjI2ODFjZTEwNzViNDliM2M1YWNiZjhhZDIxYjVhMDk2MjIiLCJpYXQiOjE2OTg4OTc1NDIuNDA1NTk1LCJuYmYiOjE2OTg4OTc1NDIuNDA1NTk4LCJleHAiOjE3MzA1MTk5NDIuMzk4NjExLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.xqg6m-YLKPFBLwmOjoF2EN8EHg3LuuVTjM8Q1X6gm2z9P98Fff1DJ3-Ecu_zBxah7vfzowSBU-MLM2IKRCiIQdxtKTtSZO3wakSJjulFsxd6uI9B9n2stOZjs6i1mngLzF1ZNS6xfBvd1RPW_guktXY3O9IB55-ShnnghYfFWkG369ltRhCMEx_Z66mLmWnTdFRSpcyNzmYNAdmIlMPesVbAG1BeIgiy9Pn7u2kHuAqSmDHJ8GmgRwlkg7M3in1TCVmV57_3Uq1K_mbNfW_V_M1h1l7RZYu2SiYAiEIkouYhlMm143t2CQmGxDB1EH4X5LP1UlFZUYEgptVDinePZmH17evtAAfvOtgnqEhLNJobMLgzaFtv4HLk37UGb-txh6fjD7DLBxuIQHlwOerWLpq46zAzCM4F_0ldcyPB2Tj8vt45rhxaaVd_ICfHTLeZ6woVpCqYcsE7_CLnPaCX28PaE39K0O8lYp0IH2JBDE5rIXendvnqPGk3Hjw610m896yPblGwwMEHQqWQOgB3ePaxfHthr5pEVuYUedaYuXqx6OEg6qNzDUOTA6vRUoOleRQuq-O4Pr5xgnJvRJ8wL_o1LrqG-OLt4eWYouFVDNG1VO2DqK28lNzTXly5VcmS4lGDNhjcRh6idBkI-_2r04HrbfRZZWcD3eq5bTmj-ec",
     *                       "user": {
     *                           "id": 1,
     *                           "name": "superadmin",
     *                           "email": "superadmin@gmail.com",
     *                           "email_verified_at": null,
     *                           "created_at": "2023-11-01T07:31:40.000000Z",
     *                           "updated_at": "2023-11-01T07:31:40.000000Z"
     *                       }
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
     *                    "message": "Login Gagal, Data yang Anda Masukkan Tidak Ada pada Sistem Kami",
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
     *)
     **/
    public function login(Request $request)
    {
        try {
            return $this->repository->login($request);
        } catch (\Exception $th) {
            return $this->response->error($th->getMessage());
        }
    }
}

