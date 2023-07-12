<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function getRouteKey()
    {
        return $this->slug;
    }

    public static function slugger($string)
    {
        //Post::slugger($title)

        //generare lo slug base

        $baseSlug = Str::slug($string); //ciao-a-tutti
        $i = 1;
        $slug = $baseSlug;

        //finchè lo slug generato è presente nella tabella
        while (Project::where('slug', $slug)->first()) {

            //genera un nuovo slug concatenando il contatore
            $slug = $baseSlug . '-' . $i; //ciao-a-tutti-1

            //incrementa il contatore
            $i++; //ciao-a-tutti-2
        }

        //verificare se lo slug è già presente nella colonna slug della tabella

        //se è presente incrementare un contatore e concatenare il numero allo slug base

        //ripetere finchp non generiamo uno slug no presente nel db

        //ritornare allo slug trovato

        return $slug;
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
