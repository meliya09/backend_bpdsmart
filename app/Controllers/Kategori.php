<?php namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class Kategori extends BaseController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new KategoriModel();
        $data = $model->getAllKategori();
        return $this->respond($data);
    }
 
    // get single product
    public function show($konten_parent)
    {
        try {
            $model = new KategoriModel();
            $data = $model->getAllKonven();

            return $this->getResponse(
                [
                    'message' => 'Kategori retrieved successfully',
                    'kategori' => $data
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
        $model = new KategoriModel();
        $data = [
            'kategori_id' => $this->request->getVar('kategori_id'),
            'kategori_nama' => $this->request->getVar('kategori_nama'),
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
    public function update($id = null)
    {
        $model = new KategoriModel();
        $input = $this->request->getRawInput();
        $data = [
            'kategori_id' => $input['kategori_id'],
            'kategori_nama' => $input['kategori_nama'],
        ];
        $model->update($id, $data);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }
 
    // delete product
    public function delete($id = null)
    {
        $model = new KategoriModel();
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