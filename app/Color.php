<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'ex_colors';
    protected $fillable = ['name', 'status'];
}