<?php

namespace App\Http\Controllers;

use App\Helpers\ValidatorHelper;
use Illuminate\Http\Request;
use App\Models\MasterData\MasterDataBuku as Buku;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function books()
    {
        $data = Buku::all();
        return response()->json([
            "datas" => $data,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $validator = ValidatorHelper::ValidatorBuku($request->all());
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first(),
            ], 400);
        }

        $addBuku = Buku::create(array_merge($validator->validated()));

        if (count($addBuku) == 1) {
            return response()->json([
                "message" => "Berhasil menambahkan data!"
            ], 200);
        }

        return response()->json([
            "message" => "Error"
        ], 400);
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
