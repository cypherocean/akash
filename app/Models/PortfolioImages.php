<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImages extends Model
{
    use HasFactory;
    protected $table = 'portfolio_images';
    protected $fillable = [ 'portfolio_id' , 'images', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
}
