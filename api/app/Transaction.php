<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'to', 'from', 'details', 'amount'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
