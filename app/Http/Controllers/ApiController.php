<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponses;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\updateRequest;
use App\Http\Resources\ApiResource;

class ApiController extends Controller
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {//for sigle element we use : new ApiResource Insted of ApiResource::collection()

       return $this->indexResponse(ApiResource::collection(Post::all())); // Group of element 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
       $data = Post::create([
            'name' => $request->name,
            'content' => $request->content,
       ]);
       
       return $this->storeResponse(new ApiResource($data))  ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $test)
    { 
        //Error 4040 handled in App/Exception/handler.php  render method
       // $test = Post::find($id);
        // if(!$test)
        //      return $this->notFoundErrorResponse();
        
        return $this->showResponse(new ApiResource($test));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(updateRequest $request, string $id)
    {
        $test = Post::find($id);
        if(!$test)
             return $this->notFoundErrorResponse();
        //update is non static metode That retirns boonean
     $test->update([
            'name'=> $request->name,
            'content'=> $request->content,
        ]);

        return $this->updateResponse(new ApiResource($test));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $test)
    {
       Post::destroy($test->id); //or $post = Post::find($test->id);   $post->delet();
       return  $this->destroyResponse($test); 
    }
}
