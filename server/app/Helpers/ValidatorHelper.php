<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class ValidatorHelper
{
 public static function ValidatorBuku($data)
 {
  $rules = [
   'nama_buku' => ['required'],
   'jlh_halaman' => ['required', 'numeric', 'min:1'],
   'cover_buku' => ['required'],
   'penulis' => ['required'],
   'penerbit' => ['required'],
   'isbn' => ['required', 'numeric'],
  ];

  $messages = [
   'nama_buku.required' => 'Harap masukkan nama buku',
   'jlh_halaman.required' => 'Harap masukkan jumlah halaman',
   'jlh_halaman.numeric' => 'Jumlah halaman harus berupa angka',
   'jlh_halaman.min:1' => 'Jumlah halaman minimal 1',
   'cover_buku.required' => 'Harap masukkan cover buku',
   'penulis.required' => 'Harap masukkan nama penulis',
   'penerbit.required' => 'Harap masukkan nama penerbit',
   'isbn.required' => 'Harap masukkan ISBN',
   'isbn.numeric' => 'ISBN harus berupa angka',
  ];

  return Validator::make($data, $rules, $messages);
 }
}
