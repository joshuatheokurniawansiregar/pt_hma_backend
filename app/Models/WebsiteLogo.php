<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteLogo extends Model
{
    use HasFactory;

    protected $fillable=[
        'logo_file_path',
        'logo_file_name',
        'logo_file_link'
    ];
}
