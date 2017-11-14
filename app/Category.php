<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'ex_categories';
    protected $fillable = ['name', 'status'];
}