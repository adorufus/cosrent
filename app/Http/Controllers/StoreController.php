<?php

namespace App\Http\Controllers;

use App\Models\Costumes;
use App\Models\Store;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    protected $authUser;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authUser = auth()->user();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'description' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $createdStore = Store::create(array_merge(
                $validator->validated(),
                [
                    'description' => $request->description
                ]
            ));

            $now = new DateTime();

            User::where('id', $this->authUser->id)->update(['store' => $createdStore->id]);

            return response()->json([
                'message' => 'Your store successfuly created',
                'data' => $createdStore
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error occured',
                'error' => $e
            ], 400);
        }
    }

    public function getAll()
    {
        try {
            $data = Store::all();

            return response()->json([
                'message' => 'Fetch Success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Fetch failed',
                'error' => $e
            ], 400);
        }
    }

    public function getById(Request $request)
    {
        try {
            $storeId = $request->query('id');

            $data = Store::find($storeId);
            $costume_data = Costumes::where('store_id', $storeId)->get();;

            return response()->json([
                'message' => 'Fetch success',
                'data' => $data,
                'costumes_data' => $costume_data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Fetch failed',
                'error' => $e
            ], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $storeId = $request->query('id');


            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'description' => 'string',
            ]);

            $data = Store::where('id', $storeId)->update(array_merge(
                $validator->validated(),
                [
                    'description' => $request->description
                ]));

            return response()->json([
                'message' => 'Update success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Update failed',
                'error' => $e
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        $storeId = $request->query('id');

        try {
            Store::where('id', $storeId)->delete();
            User::where('id', $this->authUser->id)->update(['store' => null]);

            return response()->json([
                'message' => 'Delete success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Delete failed',
                'error' => $e
            ], 400);
        }
    }
}
