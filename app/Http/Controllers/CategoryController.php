<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(),[
            
        ]);
    }

    public function getAll() {

    }

    public function getById() {

    }

    public function update() {

    }

    public function delete() {

    }
}
