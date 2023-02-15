<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDataBuku extends Model
{
    use HasFactory;

    protected $table = 'master_data_buku';
    protected $guarded = ['id'];
}
