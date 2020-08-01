<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $table = 'products';

    protected $fillable = [
        'name', 'description', 'price', 'image'
    ];

    public function search($filter = null){
        $results = $this->where(function($query) use($filter){
            if($filter){
                $query->where('name', 'LIKE', "%{$filter}%");
            }
        })//->toSql();
        ->paginate();

        // dd($results);
        return $results;
    }

}
