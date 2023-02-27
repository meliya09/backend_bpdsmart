<?php namespace App\Controllers;

use App\Models\SyariahModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class Syariah extends BaseController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new SyariahModel();
        $data = $model->getAllSyariah();
        return $this->respond($data);
    }
 
    // get single product
    public function show($id)
    {
        try {
            $model = new SyariahModel();
            $data = $model->findSyariahById($id);

            return $this->getResponse(
                [
                    'message' => 'Produk Syariah retrieved successfully',
                    'syariah' => $data
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
        $model = new SyariahModel();
        $data = [
            'konten_parent' => 3,
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
    // public function update($id){

	// 	helper(['form', 'array']);

	// 	$rules = [
	// 		'konten_parent' => 3,
	// 		'konten_menu' => 'required',
	// 		'kategori_id' => 'required',
	// 	];
	// 		$data = [
	// 			'konten_id' => $id,
	// 			'konten_parent' => 3,
	// 			'konten_menu' => $this->request->getVar('konten_menu'),
	// 			'kategori_id' => $this->request->getVar('kategori_id'),

	// 		];
    //         $model = new SyariahModel();
    //         $model->save($data);
	// 		return $this->respond($data);
		

	// }
    public function update($id){

		helper(['form', 'array']);

		$rules = [
			// 'konten_parent' => 'required',
			'konten_menu' => 'required',
			'kategori_id' => 'required',
			
		];


		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			//$input = $this->request->getRawInput(); gsa
			$data = [
				'konten_id' => $id,
				'konten_parent' => 3,
				'konten_menu' => $this->request->getVar('konten_menu'),
				'kategori_id' => $this->request->getVar('kategori_id'),
				
			];
            $model = new SyariahModel();
            $model->save($data);
            return $this->respond($data);
		}
		

	}
    // public function update($id)
    // {
    //     try {
    //         $model = new SyariahModel();
    //         $model->findSyariahById($id);

    //         $input = $this->getRequestInput($this->request);

    //         $model->update($id, $input);
    //         $syariah = $model->findSyariahById($id);

    //         return $this->getResponse(
    //             [
    //                 'message' => 'produk syariah updated successfully',
    //                 'syariah' => $syariah
    //             ]
    //         );
    //     } catch (Exception $exception) {

    //         return $this->getResponse(
    //             [
    //                 'message' => $exception->getMessage()
    //             ],
    //             ResponseInterface::HTTP_NOT_FOUND
    //         );
    //     }
    // }
 
    // delete product
    public function delete($id = null)
    {
        $model = new SyariahModel();
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

 
// use CodeIgniter\RESTful\ResourceController;
// use CodeIgniter\API\ResponseTrait;
// use App\Models\SyariahModel;
 
// class Syariah extends ResourceController
// {
//     /**
//      * Return an array of resource objects, themselves in array format
//      *
//      * @return mixed
//      */
//     use ResponseTrait;
//     public function index()
//     {
//         $model = new SyariahModel();
//         $data = $model->getAllSyariah();
//         return $this->respond($data);
//     }
 
//     /**
//      * Return the properties of a resource object
//      *
//      * @return mixed
//      */
//     public function show($id = null)
//     {
//         $model = new SyariahModel();
//         $data = $model->findSyariahById($id);
//         //  $findById = $model->find(['id' => $id]);
//         if($data){
//             return $this->respond($data);
//         }else{
//             return $this->failNotFound('No Data Found with id '.$id);
//         }

//     }
 
//     /**
//      * Create a new resource object, from "posted" parameters
//      *
//      * @return mixed
//      */
//     public function create()
//     {
//         helper(['form']);
//         $rules = [
//             'konten_menu' => 'required',
//             'kategori_id' => 'required'
//         ];
//         $data = [
//             'konten_parent' => 3,
//             'konten_menu' => $this->request->getVar('konten_menu'),
//             'kategori_id' => $this->request->getVar('kategori_id')
//         ];
//         if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
//         $model = new SyariahModel();
//         $model->save($data);
//         $response = [
//             'status' => 201,
//             'error' => null,
//             'messages' => [
//                 'success' => 'Data Inserted'
//             ]
//         ];
//         return $this->respondCreated($response);
//     }
 
//     /**
//      * Add or update a model resource, from "posted" properties
//      *
//      * @return mixed
//      */
//     public function update($id = null)
//     {
//         helper(['form']);
//         $rules = [
//             'konten_menu' => 'required',
//             'kategori_id' => 'required'
//         ];
//         $data = [
//             'konten_id' => $id,
//             'konten_parent' => 3,
//             'konten_menu' => $this->request->getVar('konten_menu'),
//             'kategori_id' => $this->request->getVar('kategori_id')
//         ];
//         if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
//         $model = new SyariahModel();
//         $findById = $model->findSyariahById($id);
//         if(!$findById) return $this->failNotFound('No Data Found');
//         $model->update($id, $data);
//         $response = [
//             'status' => 200,
//             'error' => null,
//             'messages' => [
//                 'success' => 'Data Updated'
//             ]
//         ];
//         return $this->respond($response);
//     }
 
//     /**
//      * Delete the designated resource object from the model
//      *
//      * @return mixed
//      */
//     public function delete($id = null)
//     {
//         $model = new SyariahModel();
//         $findById = $model->findSyariahById($id);
//         if(!$findById) return $this->failNotFound('No Data Found');
//         $model->delete($id);
//         $response = [
//             'status' => 200,
//             'error' => null,
//             'messages' => [
//                 'success' => 'Data Deleted'
//             ]
//         ];
//         return $this->respond($response);
//     }
// }