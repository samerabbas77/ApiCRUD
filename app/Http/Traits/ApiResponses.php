<?php
namespace App\Http\Traits;

    trait ApiResponses
    {

        public function indexResponse($data)
        {
            return response()->json([
                'data'=> $data,
                'message' => "All usaer successfuky sent",
                'status'=> 200,
            ],200);
        }

        public function showResponse($data)
        {
            return response()->json([
                'data' => $data,
                'message' => 'Show Post Successfuly',
                'Status'=> 200
            ],200);
        }

        public function storeResponse($data)
        {
            return response()->json([
                'data' => $data,
                'message' => 'Create Post Successfuly',
                'Status'=> 201
            ],201);
        }

        public function updateResponse($data)
        {
            return response()->json([
                'data' => $data,
                'satuas'=> 'Success',
                'message' => 'Update Post Successfuly',
                'Status'=> 201
            ],201);
        } 

        
        public function destroyResponse($data)
        {
            return response()->json([
                'id' => $data->id,
                'satuas'=> 'Success',
                'message' => 'Deletet Post Successfuly',
                'Status'=> 201
            ],201);
        } 

        public function notFoundErrorResponse()
        {
            return response()->json([
                'data' => 'Error',
                'message' =>'the element dosent found ' ,
                'Status'=> 404,
            ],404);
        } 

       public function faildLoginResponse()
        {
            return response()->json([
                'message' => 'Invalid login details',
                'status'  => 'false',
                'code'    => 401
            ], 401);
        }

        public function loginResponse($data,$token)
        {
            return response()->json([
                'user'         =>$data,
                'message'      =>"Login Success",
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        public function regesterResponse($data,$token)
        {
            return response()->json([
                'user'         =>$data,
                'message'      =>"Regester and Give Token Successfully",
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    
        public function logoutResponse($data)
        {
            return response()->json([
                'user'      =>$data,
                'status'    =>'true',
                'Message'   =>'Current Uesr Logout',
            ]);
        }
    }


?>