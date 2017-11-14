<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Howdid extends Model
{
    protected $table = 'ex_howdid';
    protected $fillable = ['name', 'status'];
}