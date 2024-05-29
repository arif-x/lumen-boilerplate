<?php

namespace App\Repositories\Dashboard;

use Illuminate\Support\Facades\Validator;
use App\Traits\Response;
use App\Models\Contact;

class ContactRepository
{

    private $response;
    private $contact;

    public function __construct(
        Response $response,
        Contact $contact
    )
    {
        $this->response = $response;
        $this->contact = $contact;
    }

    public function index($request){
        $data = $this->contact->orderBy('id', ($request['sort']) ? $request['sort'] : 'desc')->where(function($q) use ($request){
            $q->orWhere('type', 'like', '%'.$request['search'].'%')
            ->orWhere('name', 'like', '%'.$request['search'].'%')
            ->orWhere('contact', 'like', '%'.$request['search'].'%');
        })->paginate(($request['limit']) ? $request['limit'] : 10);

        return $this->response->index($data);
    }

    public function show($id){
        $data = $this->contact->find($id);
        $returned = null;
        ($data) ? $returned = $this->response->show($data) : $returned = $this->response->notFound();
        return $returned;
    }

    public function store($request){
        $validation = Validator::make($request->all(), [
            'type' => 'required',
            'name' => 'required',
            'contact' => 'required',
        ]);

        if($validation->fails()){
            return $this->response->validationError($validation->errors());
        } else {
            $data = $this->contact->create([
                'type' => $request['type'],
                'name' => $request['name'],
                'contact' => $request['contact'],
            ]);
            
            $returned = null;
            ($data) ? $returned = $this->response->store($data) : $returned = $this->response->storeError();
            return $returned;
        }
    }

    public function update($id, $request){
        $validation = Validator::make($request->all(), [
            'type' => 'required',
            'name' => 'required',
            'contact' => 'required',
        ]);

        if($validation->fails()){
            return $this->response->validationError($validation->errors());
        } else {
            $data = $this->contact->where('id', $id)->update([
                'type' => $request['type'],
                'name' => $request['name'],
                'contact' => $request['contact'],
            ]);
            
            $returned = null;
            ($data) ? $returned = $this->response->update($data) : $returned = $this->response->updateError();
            return $returned;
        }
    }

    public function destroy($id){
        $check = $this->contact->find($id);
        if($check){
            $data = $this->contact->find($id)->delete();
            $returned = null;
            ($data) ? $returned = $this->response->destroy($data) : $returned = $this->response->destroyError();
            return $returned;
        } else {
            return $this->response->notFound();
        }
    }
}