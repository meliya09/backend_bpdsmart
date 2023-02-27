<?php namespace App\Controllers;

use App\Models\DepositoSyariahModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class DepositoSyariah extends BaseController
{
    use ResponseTrait; 
    // get all product
    public function index()
    {
        $model = new DepositoSyariahModel();
        $data = $model->getAllDepositoSyariah();
        return $this->respond($data);
    }
 
    // get single product
    public function show($konten_id)
    {
        try {
            $model = new DepositoSyariahModel();
            $data = $model->findDepositoSyariahById($konten_id);

            return $this->getResponse(
                [
                    'message' => 'Deposito Syariah retrieved successfully',
                    'depositosyariah' => $data
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
        $model = new DepositoSyariahModel();
        $data = [
            'konten_parent' => 50,
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
			'konten_parent' => 50,
			'konten_menu' => 'required',
			'kategori_id' => 'required',
		];
			$data = [
				'konten_id' => $konten_id,
				'konten_parent' => 50,
				'konten_menu' => $this->request->getVar('konten_menu'),
				'kategori_id' => $this->request->getVar('kategori_id'),

			];
            $model = new DepositoSyariahModel();
            $model->save($data);
			return $this->respond($data);
		

	}
 
    // delete product
    public function delete($id = null)
    {
        $model = new DepositoSyariahModel();
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