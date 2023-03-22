<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamBuku extends Model
{
    use HasFactory;

    protected $table = 'master_data_peminjaman_buku';
    protected $guarded = ['id'];

    public function detail_pinjam()
    {
        return $this->hasMany(DetailPinjamBuku::class, 'id_peminjaman', 'id')->with('buku');
    }
}
