<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    protected $table = 'transactions';

    protected $fillable = array('name', 'description', 'type', 'amount');

    public $timestamps = false;

}