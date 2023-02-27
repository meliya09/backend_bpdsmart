<?php namespace App\Controllers;

use App\Models\LokasiLayananATMModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;
 
class LokasiLayananATM extends ResourceController
{
	protected $modelName = 'App\Models\LokasiLayananATMModel';
	protected $format = 'json';
	use ResponseTrait;

	public function index(){
		$posts = $this->model->getAllLokasiLayananATM();
		return $this->respond($posts);
	}

	public function show($id = null){
		$data = $this->model->findLokasiLayananATMById($id);
		return $this->respond($data);
	}

	public function create(){
		helper(['form']);

		$rules = [
			'lokasi_gambar' => 'uploaded[lokasi_gambar]|max_size[lokasi_gambar, 1024]|is_image[lokasi_gambar]',
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

			//Get the file
			
			$file = $this->request->getFile('lokasi_gambar');
			$profile_image = $file->getName();

		// Renaming file before upload
		$temp = explode(".",$profile_image);
		$newfilename = round(microtime(true)) . '.' . end($temp);

		if ($file->move("images", $newfilename)) {

			$fileModel = new LokasiLayananModel();

			$data = [
				
				'lokasi_parent' => 160,
				'lokasi_nama' => $this->request->getVar('lokasi_nama'),
				'lokasi_alamat' => $this->request->getVar('lokasi_alamat'),
				'lokasi_telp' => $this->request->getVar('lokasi_telp'),
				'lokasi_gambar' => $newfilename,
				'file_path' => "/images/" . $newfilename,
				'lokasi_lat' => $this->request->getVar('lokasi_lat'),
				'lokasi_lon' => $this->request->getVar('lokasi_lon'),
				
			];

			
		} 
			$post_id = $this->model->insert($data);
			$data['post_id'] = $post_id;

			return $this->respondCreated($data);
		}
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


		$fileName = dot_array_search('lokasi_gambar.name', $_FILES);

		if($fileName != ''){
			$images = ['lokasi_gambar' => 'uploaded[lokasi_gambar]|max_size[lokasi_gambar, 1024]|is_image[lokasi_gambar]'];
			$rules = array_merge($rules, $images);
		}
		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'lokasi_id' => $id,
				'lokasi_parent' => 160,
				'lokasi_nama' => $this->request->getVar('lokasi_nama'),
				'lokasi_alamat' => $this->request->getVar('lokasi_alamat'),
				'lokasi_telp' => $this->request->getVar('lokasi_telp'),
				'lokasi_fax' => $this->request->getVar('lokasi_fax'),
				'lokasi_lat' => $this->request->getVar('lokasi_lat'),
				'lokasi_lon' => $this->request->getVar('lokasi_lon'),
			];
			

			if($fileName != ''){

				$file = $this->request->getFile('lokasi_gambar');
				$profile_image = $file->getName();

				$temp = explode(".",$profile_image);
				$newfilename = round(microtime(true)) . '.' . end($temp);

				if(! $file->isValid())
					return $this->fail($file->getErrorString());

				$file->move("images", $newfilename);
				
				$data['lokasi_gambar'] = $file->getName();
				$data['file_path'] = "/images/".$file->getName();
				
			}
			 
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