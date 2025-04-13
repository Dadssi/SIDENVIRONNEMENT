<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChampFormule extends Model
{
    protected $fillable = ['formule_id', 'nom_champ', 'libelle'];


    public function formule()
{
    return $this->belongsTo(Formule::class);
}

}
