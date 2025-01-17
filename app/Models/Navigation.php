<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;

    protected $fillable=[
        'icon_file_path',
        'icon_file_name',
        'icon_file_link',
        'page_link'
    ];
}
