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
   'kategori' => ['required'],
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

 public static function ValidatorAuth($data)
 {
  $rules = [
   'email' => ['required', 'email', 'exists:users'],
   'password' => ['required', 'min:8'],
  ];

  $messages = [
   'email.required' => 'Harap masukkan email anda',
   'email.email' => 'Tolong masukkan email yang valid',
   'email.exists' => 'Email tidak ditemukan',
   'password.required' => 'Tolong masukkan password',
   'password.min' => 'Password minimal 8',
  ];

  return Validator::make($data, $rules, $messages);
 }

 public static function ValidatorRegister($data)
 {
  $rules = [
   'name' => ['required'],
   'sekolah' => ['required'],
   'email' => ['required', 'email', 'unique:users'],
   'password' => ['required', 'min:8'],
  ];

  $messages = [
   'nama.required' => 'Harap masukkan nama anda',
   'sekolah.required' => 'Harap masukkan nama sekolah anda',
   'email.required' => 'Harap masukkan email anda',
   'email.email' => 'Tolong masukkan email yang valid',
   'email.unique' => 'Email sudah terdaftar',
   'password.required' => 'Tolong masukkan password',
   'password.min' => 'Password minimal 8',
  ];

  return Validator::make($data, $rules, $messages);
 }

 public static function ValidatorPinjam($data)
 {
  $rules = [
   'id_user' => ['required'],
  ];

  $messages = [
   'id_user.required' => 'ID User tidak valid',
  ];

  return Validator::make($data, $rules, $messages);
 }
}
