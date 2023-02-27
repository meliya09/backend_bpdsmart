<?php namespace App\Controllers;

use App\Models\ DetailKreditModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;
 
class DetailKredit extends ResourceController 
{
	protected $modelName = 'App\Models\DetailKreditModel';
	protected $format = 'json';
	use ResponseTrait;

	public function index(){
		$posts = $this->model->getAllDetailKredit();
		return $this->respond($posts);
	} 

	public function show($konten_id = null){
		$data = $this->model->findDetailKreditById($konten_id);
		return $this->respond($data);
	}

	public function create(){
		helper(['form']);

		$rules = [
			
			'konten_menu' => 'required',
			'konten_judul' => 'required',
			'konten_subjudul' => 'required',
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

			$fileModel = new DetailKreditModel();

			$data = [
				
				'konten_parent' => 95,
				'konten_menu' => $this->request->getVar('konten_menu'),
				'konten_judul' => $this->request->getVar('konten_judul'),
				'konten_subjudul' => $this->request->getVar('konten_subjudul'),
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
			// 'konten_parent' => 'required',
			// 'konten_menu' => 'required',
			'konten_judul' => 'required',
			// 'konten_subjudul' => 'required',
			// 'konten_gambar' => 'uploaded[konten_gambar]|max_size[konten_gambar, 1024]|is_image[konten_gambar]'
			// 'file_path' => "/images/" . $newfilename,
			'konten_deskripsi' => 'required',
			'konten_syarat' => 'required',
			'konten_ketentuan' => 'required',
			'konten_fasilitas' => 'required',
			// 'konten_promosi_gambar' => 'required',
			// 'konten_promosi_text' => 'required',
			// 'konten_simulasi' => 'required',
			'konten_sk' => 'required',
			
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
				'konten_parent' => 8,
				// 'file_path' => "/images/" . $newfilename,
				// 'konten_menu' => $this->request->getVar('konten_menu'),
				'konten_judul' => $this->request->getVar('konten_judul'),
				// 'konten_subjudul' => $this->request->getVar('konten_subjudul'),
				'konten_deskripsi' => $this->request->getVar('konten_deskripsi'),
				'konten_syarat' => $this->request->getVar('konten_syarat'),
				'konten_ketentuan' => $this->request->getVar('konten_ketentuan'),
				// 'konten_promosi_gambar' => $this->request->getVar('konten_promosi_gambar'),
				// 'konten_promosi_text' => $this->request->getVar('konten_promosi_text'),
				// 'konten_simulasi' => $this->request->getVar('konten_simulasi'),
				'konten_fasilitas' => $this->request->getVar('konten_fasilitas'),
				'konten_sk' => $this->request->getVar('konten_sk'),
				'konten_approval' => 0,

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
			// 'konten_parent' => 'required',
			// 'konten_menu' => 'required',
			'konten_judul' => 'required',
			// 'konten_subjudul' => 'required',
			// 'konten_gambar' => 'uploaded[konten_gambar]|max_size[konten_gambar, 1024]|is_image[konten_gambar]'
			// 'file_path' => "/images/" . $newfilename,
			'konten_deskripsi' => 'required',
			'konten_syarat' => 'required',
			'konten_ketentuan' => 'required',
			'konten_fasilitas' => 'required',
			// 'konten_promosi_gambar' => 'required',
			// 'konten_promosi_text' => 'required',
			// 'konten_simulasi' => 'required',
			'konten_sk' => 'required',
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
				'konten_parent' => 8,
				// 'file_path' => "/images/" . $newfilename,
				// 'konten_menu' => $this->request->getVar('konten_menu'),
				'konten_judul' => $this->request->getVar('konten_judul'),
				// 'konten_subjudul' => $this->request->getVar('konten_subjudul'),
				'konten_deskripsi' => $this->request->getVar('konten_deskripsi'),
				'konten_syarat' => $this->request->getVar('konten_syarat'),
				'konten_ketentuan' => $this->request->getVar('konten_ketentuan'),
				// 'konten_promosi_gambar' => $this->request->getVar('konten_promosi_gambar'),
				// 'konten_promosi_text' => $this->request->getVar('konten_promosi_text'),
				// 'konten_simulasi' => $this->request->getVar('konten_simulasi'),
				'konten_fasilitas' => $this->request->getVar('konten_fasilitas'),
				'konten_sk' => $this->request->getVar('konten_sk'),
				'konten_approval' => 0,

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
			// 'konten_parent' => 'required',
			// 'konten_menu' => 'required',
			'konten_judul' => 'required',
			// 'konten_subjudul' => 'required',
			// 'konten_gambar' => 'uploaded[konten_gambar]|max_size[konten_gambar, 1024]|is_image[konten_gambar]'
			// 'file_path' => "/images/" . $newfilename,
			'konten_deskripsi' => 'required',
			'konten_syarat' => 'required',
			'konten_ketentuan' => 'required',
			'konten_fasilitas' => 'required',
			// 'konten_promosi_gambar' => 'required',
			// 'konten_promosi_text' => 'required',
			// 'konten_simulasi' => 'required',
			'konten_sk' => 'required',
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
				'konten_parent' => 8,
				// 'file_path' => "/images/" . $newfilename,
				// 'konten_menu' => $this->request->getVar('konten_menu'),
				'konten_judul' => $this->request->getVar('konten_judul'),
				// 'konten_subjudul' => $this->request->getVar('konten_subjudul'),
				'konten_deskripsi' => $this->request->getVar('konten_deskripsi'),
				'konten_syarat' => $this->request->getVar('konten_syarat'),
				'konten_ketentuan' => $this->request->getVar('konten_ketentuan'),
				// 'konten_promosi_gambar' => $this->request->getVar('konten_promosi_gambar'),
				// 'konten_promosi_text' => $this->request->getVar('konten_promosi_text'),
				// 'konten_simulasi' => $this->request->getVar('konten_simulasi'),
				'konten_fasilitas' => $this->request->getVar('konten_fasilitas'),
				'konten_sk' => $this->request->getVar('konten_sk'),
				'konten_approval' => 0,

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

	public function approve($id = null){
		helper(['form', 'array']);

		$data = [
			'konten_id' => $id,
			'konten_parent' => 8,
			'konten_approval' => 1,
		];
		$model = new DetailKreditModel();
		$model->save($data);
		return $this->respond($data);
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