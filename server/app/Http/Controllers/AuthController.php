<?php

namespace App\Http\Controllers;

use App\Helpers\ValidatorHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = ValidatorHelper::ValidatorAuth($request->all());

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'token' => auth()->user(),
            ], 200);
        }
        return response()->json([
            'message' => 'error',
        ], 500);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::where('id', $id);
        if (!$request->all()) {
            $profile = $user->update([
                'foto_profil' => null
            ]);

            $updated = $user->first();

            return response()->json([
                'message' => 'Profile berhasil di update',
                'user' => $updated,
            ], 200);
        }
        $profile = $user->update(array_merge($request->all()));
        $updated = $user->first();

        if ($profile == true) {
            return response()->json([
                'message' => 'Profile berhasil di update',
                'user' => $updated,
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = ValidatorHelper::ValidatorRegister($request->all());

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $user = User::create(array_merge($request->all(), ['password' => bcrypt($request->password)]));

        if ($user) {
            return response()->json([
                'message' => 'Register berhasil'
            ], 200);
        }

        return response()->json([
            'message' => 'Error'
        ], 500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
