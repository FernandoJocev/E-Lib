<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ValidatorHelper;
use App\Models\MasterData\MasterDataBuku as Buku;
use App\Models\User\DetailPinjamBuku;
use App\Models\User\PinjamBuku;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Date;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     Cloudinary::config(array(
    //         'cloud_name' => 'dxqu8d8z8',
    //         'api_key' => '247289557368424',
    //         'api_secret' => 'd5pA01Csc3eYuQn1I2qBpW9ST-E',
    //     ));
    // }
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

    public function searchBooks(Request $request)
    {
        $data = Buku::where('nama_buku', 'LIKE', '%' . $request->get('search') . '%')->get();

        return response()->json([
            'data' => $data,
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
        // $cloudinary = new Cloudinary();
        // $cloudinary->createUploadPreset([
        //     "name" => "my_preset",
        //     "unsigned" => true,
        //     "categorization" => "google_tagging,google_video_tagging",
        //     "auto_tagging" => 0.75,
        //     "background_removal" => "cloudinary_ai",
        //     "folder" => "new-products"
        // ]);

        $addBuku = Buku::create(array_merge($validator->validated()));

        if ($addBuku != null) {
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
    public function getDetailBook($id)
    {
        $data = Buku::with('detail_pinjam_buku')->where('id', $id)->first();

        return response()->json([
            $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pinjam(Request $request, $id)
    {
        $validator = ValidatorHelper::ValidatorPinjam($request->all());

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $pinjamBuku = PinjamBuku::create(array_merge($validator->validated(), [
            // 'tgl_peminjaman' => Date::now(),
            // 'tgl_wajib_pengembalian' => Date::now()->addDay('7'),
            'status' => '',
        ]));

        $detailPinjamBuku = DetailPinjamBuku::create([
            'id_peminjaman' => $pinjamBuku->id,
            'id_buku' => $id,
            'jlh' => 1,
        ]);

        if ($pinjamBuku && $detailPinjamBuku) {
            return response()->json([
                'message' => 'Buku dipinjam, silahkan scan barcode untuk melanjutkan'
            ], 200);
        }

        return response()->json([
            'message' => 'error'
        ], 500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPinjamBuku($id)
    {
        $data = PinjamBuku::with('detail_pinjam')->where([
            'id_user' => $id,
            'status' => ''
        ])->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        if ($request->route('id') == null || !$request->route('id')) {
            return response()->json([
                'message' => 'User tidak valid'
            ], 400);
        }

        $pinjamBuku = PinjamBuku::where('id_user', $request->route('id'))->update([
            'tgl_peminjaman' => Date::now(),
            'tgl_wajib_pengembalian' => Date::now()->addDay('7'),
            'status' => 'dipinjam',
        ]);

        return response()->json([
            'message' => 'Buku terpinjam, silahkan kembalikan pada waktu yang ditentukan yaa'
        ], 200);
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
