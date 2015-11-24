<?php

namespace foodplan;

use Illuminate\Database\Eloquent\Model;
use foodplan\Recipe;

class Plan extends Model
{
    protected $fillable = ['timestamp'];
    public function recipe()
    {
        return Recipe::firstOrNew(['id' => $this->recipeid]);
    }
    
}
