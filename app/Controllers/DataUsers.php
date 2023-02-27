<?php namespace App\Controllers;

use App\Models\StafModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use Exception;
 
class DataUsers extends BaseController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new StafModel();
        $data = $model->getAllUser();
        return $this->respond($data);
    }
 
    // get single product
    public function show($id)
    {
        try {
            $model = new StafModel(); 
            $data = $model->findUserById($id);

            return $this->getResponse(
                [
                    'message' => 'User retrieved successfully',
                    'datausers' => $data
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
    public function create()
    {
        $rules = [ 
            'user_nama' => 'required',
            'user_jabatan' => 'required',
            'user_email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[dbo_user.user_email]',
            'user_password' => 'required',
            'user_telp' => 'required',
            'level_id' => 'required', 
            'user_admin' => 'required'
        ];

        $input = $this->getRequestInput($this->request);
        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                        $this->validator->getErrors(),
                        ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $userModel = new StafModel();
        $userModel->save($input);

        return $this->getJWTForUser(
                $input['user_email'],
                ResponseInterface::HTTP_CREATED
            );
    }

    // update product
//  public function update($id = null){

//     helper(['form', 'array']);

//     $rules = [
//         'user_nama' => 'required',
//         'user_jabatan' => 'required',
//         'user_email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[dbo_user.user_email]',
//         // 'user_password' => 'required',
//         'user_telp' => 'required',
//         'level_id' => 'required',
//         'user_admin' => 'required'
//     ];
//         $data = [
//             'user_id' => $id,
//             'user_nama' => $this->request->getVar('user_nama'),
//             'user_jabatan' => $this->request->getVar('user_jabatan'),
//             'user_email' => $this->request->getVar('user_email'),
//             // 'user_password' => $this->request->getVar('user_password'),
//             'user_telp' => $this->request->getVar('user_telp'),
//             'level_id' => $this->request->getVar('level_id'),
//             'user_admin' => $this->request->getVar('user_admin'),
//         ];
//         $model = new StafModel();
//         $model->save($data);
//         return $this->respond($data);
// }

public function update($id)
{
    try {
        $model = new StafModel();
        $model->findUserById($id);

        $input = $this->getRequestInput($this->request);

        $model->update($id, $input);
        $datausers = $model->findUserById($id);

        return $this->getResponse(
            [
                'message' => 'datausers updated successfully',
                'datausers' => $datausers
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
    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login()
    {
        $rules = [
            'user_email' => 'required|min_length[6]|max_length[50]|valid_email',
            'user_password' => 'required|min_length[6]|max_length[255]|validateUser[user_email, user_password]',
            
        ];

        $errors = [
            'user_password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ]; 

        $input = $this->getRequestInput($this->request);


        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }
        return $this->getJWTForUser($input['user_email']);
    }

    private function getJWTForUser(string $emailAddress, int $responseCode = ResponseInterface::HTTP_OK) 
    {
        try {
            $model = new StafModel();
            $dbo_user = $model->findUserByEmailAddress($emailAddress);
            unset($dbo_user['user_password']);

            helper('jwt');

            return $this->getResponse([
                'dbo_user' => $dbo_user,
                'access_token' => getSignedJWTForUser($emailAddress)
            ]
               
                    // [
                    //     'user_nama' => $dbo_user['user_nama'],
                    //     'user_email' => $dbo_user['user_email'],
                    //     'user_admin' => $dbo_user['user_admin'],
                    //     'access_token' => getSignedJWTForUser($emailAddress)
                    // ]
                );
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    $responseCode
                );
        }
    }

    // use ResponseTrait;
    // // get all product
    // public function index()
    // {
    //     $model = new UserModel();
    //     $data = $model->getAllUser();
    //     return $this->respond($data);
    // }

    // // get single product
    // public function show($id)
    // {
    //     try {
    //         $model = new UserModel();
    //         $dbo_user = $model->findUserById($id);

    //         return $this->getResponse(
    //             [
    //                 'message' => 'User retrieved successfully',
    //                 'dbo_user' => $dbo_user
    //             ]
    //         );
    //     } catch (Exception $e) {
    //         return $this->getResponse(
    //             [
    //                 'message' => 'Could not find user for specified ID'
    //             ],
    //             ResponseInterface::HTTP_NOT_FOUND
    //         );
    //     }
    // }
 
    // // create a product
    // public function create()
    // { 
    //     $model = new UserModel();
    //     $data = [
    //         'user_nama' => $this->request->getVar('staf_nama'),
    //         'user_jabatan' => $this->request->getVar('staf_jabatan'),
    //         'user_email' => $this->request->getVar('staf_email'),
    //         'user_telp' => $this->request->getVar('staf_telp'),
    //         'level_id' => $this->request->getVar('level_id'),
    //         'user_admin' => $this->request->getVar('user_admin'),
    //     ];
    //     $model->insert($data);
    //     $response = [
    //         'status'   => 201,
    //         'error'    => null,
    //         'messages' => [
    //             'success' => 'Data Saved'
    //         ]
    //     ];
    //     return $this->respondCreated($response);
    // }
 
    // // update product
    // // public function update($id)
    // // {
        
    // //     $model = new StafModel();
    // //     $input = $this->request->getRawInput();
    // //     $data = [
          
    // //         // 'staf_admin' => $input['staf_admin'],
    // //         'staf_nama' => $input['staf_nama'],
    // //         'staf_jabatan' => $input['staf_jabatan'],
    // //         'staf_email' => $input['staf_email'],
    // //         'staf_telp' => $input['staf_telp'],
    // //     ];
    // //     $model->update($id, $data);

    // //     $response = [
    // //         'status'   => 200,
    // //         'error'    => null,
    // //         'messages' => [
    // //             'success' => 'Data Updated'
    // //         ]
    // //     ];
    // //     return $this->respond($response);
    // // }
    // public function update($id)
    // {
    //     try {
    //         $model = new UserModel();
    //         $model->findStafById($id);

    //         $input = $this->getRequestInput($this->request);

    //         $model->update($id, $input);
    //         $staf = $model->findStafById($id);

    //         return $this->getResponse(
    //             [
    //                 'message' => 'staf updated successfully',
    //                 'staf' => $staf
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
    
 
    // // delete product
    // public function delete($id = null)
    // {
    //     $model = new UserModel();
    //     $data = $model->find($id);
    //     if($data){
    //         $model->delete($id);
    //         $response = [
    //             'status'   => 200,
    //             'error'    => null,
    //             'messages' => [
    //                 'success' => 'Data Deleted'
    //             ]
    //         ];
    //         return $this->respondDeleted($response);
    //     }else{
    //         return $this->failNotFound('No Data Found with id '.$id);
    //     }
         
    // }
}
