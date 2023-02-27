<?php namespace App\Controllers;

use App\Models\ DetailInternalModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;
 
class DetailInternal extends ResourceController
{
	protected $modelName = 'App\Models\DetailInternalModel';
	protected $format = 'json';
	use ResponseTrait;

	public function index(){ 
		$posts = $this->model->getAllDetailInternal();
		return $this->respond($posts);
	}

	public function showById($id = null){
		$data = $this->model->findDetailInternalById($id);
		return $this->respond($data);
	}

	public function show($konten_parent = null){
		$data = $this->model->getByKontenParent($konten_parent);
		return $this->respond($data);
	}

	public function showParentID($konten_parent = null,$konten_id = null){
		$data = $this->model->getByKontenParentID($konten_parent,$konten_id);
		return $this->respond($data);
	}

	public function create($konten_parent = null){
		helper(['form']);

		$rules = [
			'konten_judul' => 'required',
			'konten_gambar' => 'uploaded[konten_gambar]|max_size[konten_gambar, 1024]|is_image[konten_gambar]',
			'konten_deskripsi' => 'required',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{

			//Get the file
			$file = $this->request->getFile('konten_gambar');
			$profile_image = $file->getName();

		// Renaming file before upload
		$temp = explode(".",$profile_image);
		$newfilename = round(microtime(true)) . '.' . end($temp);

		if ($file->move("images", $newfilename)) {

			$fileModel = new DetailInternalModel();

			$data = [
				'konten_parent' =>93,
				'konten_judul' => $this->request->getVar('konten_judul'),
				'konten_gambar' => $newfilename,
				'file_path' => "/images/" . $newfilename,
				'konten_deskripsi' => $this->request->getVar('konten_deskripsi'),
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
			'konten_judul' => 'required',
			'konten_deskripsi' => 'required',
		];

		$fileName = dot_array_search('konten_gambar.name', $_FILES);

		if($fileName != ''){
			$images = ['konten_gambar' => 'uploaded[konten_gambar]|max_size[konten_gambar, 1024]|is_image[konten_gambar]'];
			$rules = array_merge($rules, $images);
		} 
		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'konten_id' => $id,
				// 'konten_parent' => $konten_parent,
				'konten_judul' => $this->request->getVar('konten_judul'),
				'konten_deskripsi' => $this->request->getVar('konten_deskripsi'),
			];
			

			if($fileName != ''){

				$file = $this->request->getFile('konten_gambar');
				$profile_image = $file->getName();

				$temp = explode(".",$profile_image);
				$newfilename = round(microtime(true)) . '.' . end($temp);

				if(! $file->isValid())
					return $this->fail($file->getErrorString());

				$file->move("images", $newfilename);
				
				$data['konten_gambar'] = $file->getName();
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