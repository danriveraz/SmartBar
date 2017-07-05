<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table = 'venta';
    public function scopeSearch($query){
    	$query->where('estado','Por atender')
    			->join('producto', 'venta.idProducto', '=', 'producto.id')
    			->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
    			->select('venta.id','cantidad', 'producto.nombre','categoria.nombre as categoria');
    	return $query;
    }
    public function scopeActualizar($query, $pedidos){
    	$query->wherein('id', $pedidos)
    		  ->update(['estado' => 'Atendido']);
    			
    }
    public function scopeListarElementos($query, $id){
        $query->where('idFactura', $id)
              ->join('producto', 'venta.idProducto', '=', 'producto.id')
              ->select('nombre', 'cantidad', 'precio', 'venta.id');
        return $query;
    }
}
