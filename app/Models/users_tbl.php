<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class users_tbl extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey="id";
    protected $table="users_tbls";
    protected $fillable=['username','password','name','family','start_datetime','last_edit_datetime','role'];
    public $timestamps = false;

}
