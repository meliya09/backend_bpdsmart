<?php namespace App\Controllers;

use App\Models\KreditStandarModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class KreditStandar extends BaseController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new KreditStandarModel();
        $data = $model->getAllKreditStandar();
        return $this->respond($data);
    }
 
    // get single product
    public function show($konten_id)
    {
        try {
            $model = new KreditStandarModel();
            $data = $model->findKreditStandarById($konten_id);

            return $this->getResponse(
                [
                    'message' => 'Kredit Standar retrieved successfully',
                    'standar' => $data
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
      $model = new KreditStandarModel();
      $data = [
          'konten_parent' => 25,
          'konten_menu' => $this->request->getVar('konten_menu'),
          'kategori_id' => $this->request->getVar('kategori_id'),
          'konten_approval' => '0', 
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
  public function update($konten_id = null){
 
      helper(['form', 'array']);
 
      $rules = [
          'konten_parent' => 25,
          'konten_menu' => 'required',
          'kategori_id' => 'required',
      ];
          $data = [
              'konten_id' => $konten_id,
              'konten_parent' => 25,
              'konten_menu' => $this->request->getVar('konten_menu'),
              'kategori_id' => $this->request->getVar('kategori_id'),
 
          ];
          $model = new KreditStandarModel();
          $model->save($data);
          return $this->respond($data);
  }
 
    // delete product
    public function delete($konten_id = null)
    {
        $model = new KreditStandarModel();
        $data = $model->find($konten_id);
        if($data){
            $model->delete($konten_id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$konten_id);
        }
         
    }
 
}