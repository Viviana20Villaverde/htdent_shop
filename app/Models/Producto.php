<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $guarded = ['id', 'created_at', 'update_at'];

    const BORRADOR = 1;
    const PUBLICADO = 2;

    //Accesores
    public function getStockAttribute()
    {
        if ($this->subcategoria->tiene_medida) {
            return ColorMedida::whereHas('medida.producto', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('stock');
        } elseif ($this->subcategoria->tiene_color) {
            return ColorProducto::whereHas('producto', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('stock');
        } else {
            return $this->stock;
        }
    }

    //Relación uno a muchos
    public function medidas()
    {
        return $this->hasMany(Medida::class);
    }

    //Relación uno a muchos inversa
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    //Relación uno a muchos inversa
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    //Relación muchos a muchos
    public function colores()
    {
        return $this->belongsToMany(Color::class)->withPivot('stock', 'id');
    }
    

    //Relación uno a muchos polimoefica
    //Metodo de su modelo
    public function imagenes()
    {
        return $this->morphMany(Imagen::class, "imagenable");
    }

    //URl amigables
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
