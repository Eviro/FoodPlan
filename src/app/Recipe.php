<?php

namespace foodplan;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['displayname'];

    public function parts()
    {
        $list = [];
        foreach (explode(',',$this->components) as $component )
        {
            $list[] = Component::findOrNew($component);
        }
        return $list;
    }
}
