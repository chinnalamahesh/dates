<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Epayment extends Model
{
    protected $table = 'ex_epayments';
    protected $fillable = ['e_payments', 'status'];
}