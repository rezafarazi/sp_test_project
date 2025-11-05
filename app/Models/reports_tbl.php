<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reports_tbl extends Model
{

    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = "reports_tbls";
    protected $fillable = ['title','text','file_addres','status','datetime'];
    public $timestamps = false;

}
