<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

	//==========================
	//Relación de documento con usuario
	//==========================
	public function user() {

       return $this->belongsTo(User::class);

    }

    //==========================
	//Campos permitidos
	//==========================
    protected $fillable = [
        'name', 'url'
    ];


}


