<?php namespace App\Controllers;

use App\Models\HomeModel;
use CodeIgniter\RESTful\ResourceController; 
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;
 
class Home extends ResourceController
{
	protected $modelName = 'App\Models\HomeModel';
	protected $format = 'json';
	use ResponseTrait;
 
	public function index(){
		$posts = $this->model->getAllListHome();
		$notif = $this->model->getNotif();
		return $this->respond($posts);
		return $this->respond($notif);
	}

	// public function index($id = null){
	// 	$data = $this->model->getHome($id);
	// 	return $this->respond($data);
	// }
 
	public function show($id = null){
		$data = $this->model->getHome($id);
		return $this->respond($data);
	}

	public function update($id = null){

		helper(['form', 'array']);

		$rules = [
			'konten_judul' => 'required',
			'konten_subjudul' => 'required',
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
				'konten_judul' => $this->request->getVar('konten_judul'),
				'konten_subjudul' => $this->request->getVar('konten_subjudul'),
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

	public function update2($id = null){

		helper(['form', 'array']);

		$rules = [
			'konten_judul' => 'required',
			'konten_subjudul' => 'required',
			'konten_deskripsi2' => 'required',
		];

		$fileName = dot_array_search('konten_gambar2.name', $_FILES);

		if($fileName != ''){
			$images = ['konten_gambar2' => 'uploaded[konten_gambar2]|max_size[konten_gambar2, 1024]|is_image[konten_gambar2]'];
			$rules = array_merge($rules, $images);
		}
		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'konten_id' => $id,
				'konten_judul' => $this->request->getVar('konten_judul'),
				'konten_subjudul' => $this->request->getVar('konten_subjudul'),
				'konten_deskripsi2' => $this->request->getVar('konten_deskripsi2'),
			];
			

			if($fileName != ''){

				$file = $this->request->getFile('konten_gambar2');
				$profile_image = $file->getName();

				$temp = explode(".",$profile_image);
				$newfilename = round(microtime(true)) . '.' . end($temp);

				if(! $file->isValid())
					return $this->fail($file->getErrorString());

				$file->move("images", $newfilename);
				
				$data['konten_gambar2'] = $file->getName();
				$data['file_path2'] = "/images/".$file->getName();
				
			}
			 
			$this->model->save($data);
			return $this->respond($data);
		}
		
	}

	public function update3($id = null){

		helper(['form', 'array']);

		$rules = [
			'konten_judul' => 'required',
			'konten_subjudul' => 'required',
			'konten_deskripsi3' => 'required',
		];

		$fileName = dot_array_search('konten_gambar3.name', $_FILES);

		if($fileName != ''){
			$images = ['konten_gambar3' => 'uploaded[konten_gambar3]|max_size[konten_gambar3, 1024]|is_image[konten_gambar3]'];
			$rules = array_merge($rules, $images);
		}
		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'konten_id' => $id,
				'konten_judul' => $this->request->getVar('konten_judul'),
				'konten_subjudul' => $this->request->getVar('konten_subjudul'),
				'konten_deskripsi3' => $this->request->getVar('konten_deskripsi3'),
			];
			

			if($fileName != ''){ 

				$file = $this->request->getFile('konten_gambar3');
				$profile_image = $file->getName();

				$temp = explode(".",$profile_image);
				$newfilename = round(microtime(true)) . '.' . end($temp);

				if(! $file->isValid())
					return $this->fail($file->getErrorString());

				$file->move("images", $newfilename);
				
				$data['konten_gambar3'] = $file->getName();
				$data['file_path3'] = "/images/".$file->getName();
				
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