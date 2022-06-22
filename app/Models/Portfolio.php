<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = 'portfolio';
    protected $fillable = ['name', 'description' ,'thumbnail_image', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
}
