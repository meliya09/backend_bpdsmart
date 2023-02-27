<?php namespace App\Controllers;

use App\Models\LokasiATMModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class LokasiATM extends BaseController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new LokasiATMModel();
        $data = $model->getAllLokasiATM();
        return $this->respond($data);
    }
 
    // get single product
    public function show($id)
    {
        try {
            $model = new LokasiATMModel();
            $data = $model->findLokasiATMById($id);

            return $this->getResponse(
                [
                    'message' => 'Lokasi retrieved successfully',
                    'lokasiatm' => $data
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find client for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
 
   // create a product
   public function create()
   {
       $model = new LokasiATMModel();
       $data = [
           'lokasi_parent' => 160,
           'lokasi_nama' => $this->request->getVar('lokasi_nama'),
           'kategori_id' => $this->request->getVar('kategori_id'),
       ];
       $model->insert($data);
       $response = [
           'status'   => 201,
           'error'    => null,
           'messages' => [
               'success' => 'Data Saved'
           ]
       ];
       return $this->respondCreated($response);
   }

   // update product
   public function update($id = null){

       helper(['form', 'array']);

       $rules = [
           'lokasi_parent' => 160,
           'lokasi_nama' => 'required',
           'kategori_id' => 'required',
       ];
           $data = [
               'lokasi_id' => $id,
               'lokasi_parent' => 160,
               'lokasi_nama' => $this->request->getVar('lokasi_nama'),
               'kategori_id' => $this->request->getVar('kategori_id'),

           ];
           $model = new LokasiATMModel();
           $model->save($data);
           return $this->respond($data);
       

   }
 
    // delete product
    public function delete($id = null)
    {
        $model = new LokasiATMModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
         
    }
 
}