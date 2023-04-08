<?php

namespace App\Models\MasterData;

use App\Models\User\DetailPinjamBuku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterData\MasterKategori;

class MasterDataBuku extends Model
{
    use HasFactory;

    protected $table = 'master_data_buku';
    protected $guarded = ['id'];

    public function detail_pinjam_buku()
    {
        return $this->hasOne(DetailPinjamBuku::class, 'id_buku', 'id')->with('pinjam_buku');
    }

    public function kategori()
    {
        return $this->belongsTo(MasterKategori::class, 'kategori_id', 'id');
    }
}
