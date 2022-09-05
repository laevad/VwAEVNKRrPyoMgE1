<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{

    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'fname'=>'required',
            'lname' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);
        if ($validators->fails()){
            $errors = $validators->errors();
            $err = [
                'fname' => $errors->first('fname'),
                'lname' => $errors->first('lname'),
                'email' => $errors->first('email'),
                'password' => $errors->first('password'),
            ];
            return response()->json([
                'message' => 'Can\'t process request. Check your input',
                'errors' => $err
            ], 422);
        }
        $user = new User;
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response()->json([
            'message' => 'Registration Successful',
            'user' => $user
        ], 201);
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
