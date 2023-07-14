<?php

namespace App\Models;

namespace App\Models;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    // public function getRouteKey()
    // {
    //     return $this->slug;
    // }

    public static function slugger($string)
    {
        //Type::slugger($title)

        //generare lo slug base

        $baseSlug = Str::slug($string); //ciao-a-tutti
        $i = 1;
        $slug = $baseSlug;

        //finchè lo slug generato è presente nella tabella
        while (Type::where('slug', $slug)->first()) {

            //genera un nuovo slug concatenando il contatore
            $slug = $baseSlug . '-' . $i; //ciao-a-tutti-1

            //incrementa il contatore
            $i++; //ciao-a-tutti-2
        }

        return $slug;
    }


    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
