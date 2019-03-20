<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey='cId';
    protected $fillable=[
        'cName',
        'company',
        'contact',
        'email',
        'password',
        'type'
    ];
}
