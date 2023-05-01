<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethodMaster;
use Exception;
use Illuminate\Http\Request;
use Validator;

class PaymentMethodController extends Controller
{
    protected $authUser;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authUser = auth()->user();
    }

    public function create(Request $request)
    {
        if($this->authUser->role == 1) {
            try {
                $validator = Validator::make($request->all(), [
                    'method_name' => 'string|required',
                    'description' => 'string',
                    'account_number' => 'string'
                ]);
    
                $data = PaymentMethodMaster::create($validator->validated());
    
                return response()->json([
                    'message' => 'payment method created',
                    'data' => $data
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'payment method created',
                    'error' => $e
                ]);
            }
        } else {
            return response()->json([
                'message' => 'You have no permission!'
            ], 401);
        }
    }

    public function getAll()
    {
        try {
            $data = PaymentMethodMaster::all();

            return response()->json([
                'message' => 'fetch success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'payment method created',
                'error' => $e
            ]);
        }
    }

    public function getById(Request $request)
    {
        try {
            $paymentMethodId = $request->query('id');

            $data = PaymentMethodMaster::where('id', $paymentMethodId)->get();

            return response()->json([
                'message' => 'fetch success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'payment method created',
                'error' => $e
            ]);
        }

    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {
        try {
            $paymentMethodId = $request->query('id');

            PaymentMethodMaster::where('id', $paymentMethodId)->delete();

            return response()->json([
                'message' => 'delete success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'payment method created',
                'error' => $e
            ]);
        }
    }
}