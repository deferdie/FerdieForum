<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageVariable extends Model
{
    protected $returnable  = ['name', 'value']; 
}
