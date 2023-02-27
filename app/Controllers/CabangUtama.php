<?php namespace App\Controllers;

use App\Models\CabangUtamaModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class CabangUtama extends ResourceController
{
    protected $modelName = 'App\Models\CabangUtamaModel';
	protected $format = 'json';
	use ResponseTrait;

	public function index(){
		$posts = $this->model->getAllCabangUtama();
		return $this->respond($posts);
	}

	public function show($lokasi_id = null){
		$data = $this->model->findCabangUtamaById($lokasi_id);
		return $this->respond($data);
	}
 
    // create a product
    public function create()
    {
        $model = new CabangUtamaModel();
        $data = [
            'lokasi_parent' => 78,
            'lokasi_nama' => $this->request->getVar('lokasi_nama'),
            'lokasi_alamat' => $this->request->getVar('lokasi_alamat'),
            'lokasi_telp' => $this->request->getVar('lokasi_telp'),
            'lokasi_fax' => $this->request->getVar('lokasi_fax'),
            'lokasi_lat' => $this->request->getVar('lokasi_lat'),
            'lokasi_lon' => $this->request->getVar('lokasi_lon'),
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
        $model = new CabangUtamaModel();
        $input = $this->request->getRawInput();
        $data = [
            
            'lokasi_nama' => $input['lokasi_nama'],
            'lokasi_alamat' => $input['lokasi_alamat'],
            'lokasi_telp' => $input['lokasi_telp'],
            'lokasi_fax' => $input['lokasi_fax'],
            'lokasi_lat' => $input['lokasi_lat'],
            'lokasi_lon' => $input['lokasi_lon'],
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
        $model = new CabangUtamaModel();
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