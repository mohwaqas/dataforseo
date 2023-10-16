<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetSeoRank extends Model
{
    use HasFactory;
     protected $primaryKey = "id";
    protected $table = "tbl_get_seo_rank";

    protected $fillable = [
                'url',
        'ranked',
        'country_code',
        'device',
        'search_position',
        'search_keyword',

    ];
}
