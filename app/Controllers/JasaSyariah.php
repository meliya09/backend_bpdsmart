<?php namespace App\Controllers;

use App\Models\JasaSyariahModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class JasaSyariah extends BaseController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new JasaSyariahModel();
        $data = $model->getAllJasaSyariah();
        return $this->respond($data);
    }
 
    // get single product
    public function show($konten_id)
    {
        try {
            $model = new JasaSyariahModel();
            $data = $model->findJasaSyariahById($konten_id);

            return $this->getResponse(
                [
                    'message' => 'Jasa Syariah retrieved successfully',
                    'jasasyariah' => $data
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
        $model = new JasaSyariahModel();
        $data = [
            'konten_parent' => 47,
            'konten_menu' => $this->request->getVar('konten_menu'),
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
    public function update($konten_id = null){

		helper(['form', 'array']);

		$rules = [
			'konten_parent' => 47,
			'konten_menu' => 'required',
			'kategori_id' => 'required',
		];
			$data = [
				'konten_id' => $konten_id,
				'konten_parent' => 47,
				'konten_menu' => $this->request->getVar('konten_menu'),
				'kategori_id' => $this->request->getVar('kategori_id'),

			];
            $model = new JasaSyariahModel();
            $model->save($data);
			return $this->respond($data);
		

	}
    // delete product
    public function delete($id = null)
    {
        $model = new JasaSyariahModel();
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