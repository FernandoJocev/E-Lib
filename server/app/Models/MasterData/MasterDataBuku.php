<?php

namespace App\Models\MasterData;

use App\Models\User\DetailPinjamBuku;
use App\Models\User\PinjamBuku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDataBuku extends Model
{
    use HasFactory;

    protected $table = 'master_data_buku';
    protected $guarded = ['id'];

    public function detail_pinjam_buku()
    {
        return $this->hasOne(DetailPinjamBuku::class, 'id_buku', 'id')->with('pinjam_buku');
    }
}
