<?php

namespace App\Traits;

class Response {
	public function index($data){
        $response = [
            'status' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function show($data){
        $response = [
            'status' => true,
            'message' => 'Single Data berhasil ditampilkan',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function store($data){
        $response = [
            'status' => true,
            'message' => 'Data berhasil ditambah',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function update($data){
        $response = [
            'status' => true,
            'message' => 'Data berhasil diedit',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function destroy($data){
        $response = [
            'status' => true,
            'message' => 'Data berhasil dihapus',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function empty($data = null){
        $response = [
            'status' => true,
            'message' => 'Data berhasil ditampilkan tetapi kosong',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function notFound($data = null){
        $response = [
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => $data
        ];
        return response()->json($response, 404);
    }

    public function storeError($data = null){
        $response = [
            'status' => false,
            'message' => 'Error menambah data',
            'data' => $data
        ];
        return response()->json($response, 500);
    }

    public function updateError($data = null){
        $response = [
            'status' => false,
            'message' => 'Error mengedit data',
            'data' => $data
        ];
        return response()->json($response, 500);
    }

    public function destroyError($data = null){
        $response = [
            'status' => false,
            'message' => 'Error menghapus data',
            'data' => $data
        ];
        return response()->json($response, 500);
    }

    public function validationError($message, $data = null){
        $valArr = array();
        foreach ($message->toArray() as $key => $value) { 
            $errStr = $value[0];
            array_push($valArr, $errStr);
        }

        $errStrFinal = '';

        if(!empty($valArr)){
            $errStrFinal = implode(', ', $valArr);
        }

        $response = [
            'status' => false,
            'message' => $errStrFinal,
            'data' => $data
        ];
        return response()->json($response, 400);
    }

    public function register($data){
        $response = [
            'status' => true,
            'message' => 'Registrasi Sukses',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function registerError($data){
        $response = [
            'status' => false,
            'message' => 'Registrasi Gagal',
            'data' => $data
        ];
        return response()->json($response, 401);
    }
    
    public function login($data){
        $response = [
            'status' => true,
            'message' => 'Login Sukses',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function loginError($data = null){
        $response = [
            'status' => false,
            'message' => 'Login Gagal, Data yang Anda Masukkan Tidak Ada pada Sistem Kami',
            'data' => $data
        ];
        return response()->json($response, 402);
    }

    public function logout($data){
        $response = [
            'status' => true,
            'message' => 'Logout Sukses',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function logoutError($data){
        $response = [
            'status' => false,
            'message' => 'Logout Gagal',
            'data' => $data
        ];
        return response()->json($response, 401);
    }

    public function error($data){
        $response = [
            'status' => false,
            'message' => 'Internal Error',
            'data' => $data
        ];
        return response()->json($response, 500);
    }
}