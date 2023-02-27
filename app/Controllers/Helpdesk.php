<?php

namespace App\Controllers;

use App\Models\HelpdeskModel;
// use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;

class Helpdesk extends BaseController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new HelpdeskModel();
        $data = $model->getHelpdesk();
        return $this->respond($data);
    }

    // get single product
    public function show($id)
    {
        try {
            $model = new HelpdeskModel();
            $helpdesk = $model->findHelpdeskById($id);

            return $this->getResponse(
                [
                    'message' => 'Helpdesk retrieved successfully',
                    'helpdesk' => $helpdesk
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find helpdesk for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
 
    // create a product
    public function create()
    {
        $model = new HelpdeskModel();
        $data = [
            'level_id' => $this->request->getVar('level_id'),
            'staf_nama' => $this->request->getVar('staf_nama'),
            'staf_jabatan' => $this->request->getVar('staf_jabatan'),
            'staf_email' => $this->request->getVar('staf_email'),
            'staf_telp' => $this->request->getVar('staf_telp'),
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
 
   
    public function update($id)
    {
        try {
            $model = new HelpdeskModel();
            $model->findHelpdeskById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $helpdesk = $model->findHelpdeskById($id);

            return $this->getResponse(
                [
                    'message' => 'helpdesk updated successfully',
                    'helpdesk' => $helpdesk
                ]
            );
        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    
 
    // delete product
    public function delete($id = null)
    {
        $model = new HelpdeskModel();
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