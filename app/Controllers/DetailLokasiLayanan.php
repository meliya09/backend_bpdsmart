<?php namespace App\Controllers;

use App\Models\DetailLokasiLayananModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;
 
class DetailLokasiLayanan extends ResourceController
{
	protected $modelName = 'App\Models\DetailLokasiLayananModel';
	protected $format = 'json';
	use ResponseTrait;

	public function index(){
		$posts = $this->model->getAllDetailLokasiLayanan();
		return $this->respond($posts);
	}

	public function show($lokasi_parent = null){
		$data = $this->model->getByLokasiParent($lokasi_parent);
		return $this->respond($data);
	}

	public function showById($id = null){
		$data = $this->model->findDetailLokasiLayananById($id);
		return $this->respond($data);
	}

	public function create($lokasi_parent = null)
    {
        $model = new DetailLokasiLayananModel();
		// $data = $model->where('lokasi_parent between 78 and 84')->getByLokasiParent($id);
        $data = [
			'lokasi_parent' =>$lokasi_parent,
            'lokasi_nama' => $this->request->getVar('lokasi_nama'),
            'lokasi_alamat' => $this->request->getVar('lokasi_alamat'),
			'lokasi_telp' => $this->request->getVar('lokasi_telp'),
			'lokasi_fax' => $this->request->getVar('lokasi_fax'),
			'lokasi_lat' => $this->request->getVar('lokasi_lat'),
			'lokasi_lon' => $this->request->getVar('lokasi_lon'),
        ];
        $model->insert( $data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
        return $this->respondCreated($response);
    }

	public function update($id = null){

		helper(['form', 'array']);

		$rules = [
			// 'lokasi_gambar' => 'uploaded[lokasi_gambar]|max_size[lokasi_gambar, 1024]|is_image[lokasi_gambar]',
				'lokasi_nama' => 'required',
				'lokasi_alamat' => 'required',
				'lokasi_telp' => 'required',
				'lokasi_fax' => 'required',
				'lokasi_lat' => 'required',
				'lokasi_lon' => 'required',
		];


		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'lokasi_id' => $id,
				// 'lokasi_parent' => $id,
				'lokasi_nama' => $this->request->getVar('lokasi_nama'),
				'lokasi_alamat' => $this->request->getVar('lokasi_alamat'),
				'lokasi_telp' => $this->request->getVar('lokasi_telp'),
				'lokasi_fax' => $this->request->getVar('lokasi_fax'),
				'lokasi_lat' => $this->request->getVar('lokasi_lat'),
				'lokasi_lon' => $this->request->getVar('lokasi_lon'),
			];
			 
			$this->model->save($data);
			return $this->respond($data); 
		}
		
	} 

	public function delete($id = null){
		$data = $this->model->find($id);
		if($data){
			$this->model->delete($id);
			return $this->respondDeleted($data);
		}else{
			return $this->failNotFound('Item not found');
		}
	}
 
}