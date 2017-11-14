<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'ex_skills';
    protected $fillable = ['skill', 'status'];
}