<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formule extends Model
{
    protected $fillable = ['nom', 'description', 'expression'];


    public function champs()
{
    return $this->hasMany(ChampFormule::class);
}

}
