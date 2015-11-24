<?php

namespace foodplan;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';
    protected $fillable = ['displayname'];
}
