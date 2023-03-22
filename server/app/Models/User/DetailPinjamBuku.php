<?php

namespace App\Models\User;

use App\Models\MasterData\MasterDataBuku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPinjamBuku extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman_buku';
    protected $guarded = ['id'];

    public function buku()
    {
        return $this->hasOne(MasterDataBuku::class, 'id', 'id_buku');
    }
}
