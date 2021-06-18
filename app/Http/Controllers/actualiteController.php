<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;

class actualiteController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/actualites",
     *      operationId="getActualitesList",
     *      tags={"Actualites"},
     *      summary="Get list of actualites",
     *      description="Returns list of actualites",
     *      
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       
     *     )
     *
     * Returns list of actualites
     */
    
    public function index()
    {
        return Actualite::all();
    }

    public function show(Actualite $actualite)
    {
        return $actualite;
    }

    /**
     * @OA\Post(
     *      path="/api/actualites",
     *      operationId="storeActualite",
     *      tags={"Actualites"},
     *      summary="Store new axtualite",
     *      description="Returns actualite data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreActualiteRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Actualite")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {$actualite = Actualite::create($request->all());

        return response()->json($actualite, 201);}
        else{
            return response()->json('unauthorized modification, you do not have access',403);
        }
    }
    /**       
* @OA\Put(
    *      path="/api/actualites/{id}",
    *      operationId="getActualitesList",
    *      tags={"Actualites"},
    *      summary="modify actualites",
    *      description="return modified actualite",
    *      @OA\Parameter(
    *          name="id",
    *          description="actualite id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="successful operation"
    *       ),
    *       
    *     )
    *
    * Returns list of actualites
    */
    public function update(Request $request, Actualite $actualite)
    {
        $actualite->update($request->all());

        return response()->json($actualite, 200);
    }
    /**
     * @OA\Delete(
     *      path="api/actualites/{id}",
     *      operationId="deleteProject",
     *      tags={"Projects"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="actualite id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function delete(Actualite $actualite)
    {
        $actualite->delete();

        return response()->json(null, 204);
    }
}


