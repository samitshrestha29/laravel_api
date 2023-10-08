<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($flag)
    {
        $query = User::select('email', 'name');
        if ($flag == 1) {
            $query->where('status', 1);
        } elseif ($flag == 0) {
            // $query->where('status', 0);
        } else {
            return response()->json(['message' => 'Invalid parameter passed it can be either 1or 0', 'status' => 0,], 400);

        }
        $users = $query->get();
        if (count($users) > 0) {
            $response = ['message' => count($users) . 'User found', 'status' => 1, ' data' => $users];

        } else {
            $response = ['message' => count($users) . 'User found', 'status' => 0,];
        }
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**     
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);

        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            DB::beginTransaction();
            try {
                $user = User::create($data);
                DB::commit();

            } catch (\Exception $e) {

                p($e->getMessage());
                $user = null;
            }
            if ($user != null) {
                return response()->json([
                    'message' => 'user registered successfully'
                ], 200);
            } else {
                return response()->json(['message' => 'Internal server error'], 500);
            }
        }

    }

    /** 
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            $response = [
                'message' => 'User not found',
                'status' => 0,
            ];
        } else {
            $response = [
                'message' => 'user found',
                'status' => 1,
                'data' => $user
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}