<?php

namespace App\Http\Controllers;

use App\Models\Costumes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CostumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'description' => 'string',
                'price' => 'required|integer',
                'size.*' => 'string',
                'category.*' => 'string',
                'store_id' => 'required',
                'image_url' => 'required|string'
            ]);

            $data = Costumes::create($validator->validated());

            return response()->json([
                'message' => 'Costumes created',
                'data' => $data
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error occured',
                'error' => $e
            ], 400);
        }
    }

    public function getCostume()
    {
        try {
            $data = Costumes::all();

            return response()->json(
                [
                    'message' => 'Fetch success',
                    'data' => $data
                ]
            );
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error occured',
                'error' => $e
            ], 400);
        }
    }

    public function getCostumeById(Request $request)
    {
        try {

            $costumeId = $request->query('id');

            $data = Costumes::where('id', $costumeId)->get();

            return response()->json([
                'message' => 'Fetch Success',
                'data' => $data
            ]);

        } catch (Exception $e) {
            return response() - son([
                    'message' => 'Error occured',
                    'error' => $e
                ], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $costumeId = $request->query('id');
            $requestBody = $request->all();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'description' => 'string',
                'price' => 'required|integer',
                'size.*' => 'string',
                'category.*' => 'string',
                'store_id' => 'required',
                'image_url' => 'required|string'
            ]);

            $data = Costumes::where('id', $costumeId)->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'size' => $request->size,
                    'category' => $request->category,
                    'store_id' => $request->store_id,
                    'image_url' => $request->imag_url
                ]
            );

            return response()->json([
                'message' => 'Costumes updated',
                'data' => $data
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error occured',
                'error' => $e
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        try {

            $costumeId = $request->query('id');

            Costumes::where('id', $costumeId)->delete();

            return response()->json([
                'message' => 'delete success',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error occured',
                'error' => $e
            ], 400);
        }
    }
}
