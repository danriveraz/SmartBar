<?php

namespace PocketByR;
use DB;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $table = 'factura';

    public function ventas(){
      return $this->hasMany('PocketByR\Venta', 'idFactura', 'idFactura')
                  ->Where([
                    ['venta.estadoBartender', 'Por atender'],
                    ['venta.estadoMesero', '<>','Cancelado']
                ]);
    }

    public function mesa(){
      return $this->belongsTo('PocketByR\Mesa', 'idMesa', 'id');
    }
    public function empresa(){
      return $this->belongsTo('PocketByR\Empresa', 'idEmpresa', 'id');
    }
    public function cliente(){
      return $this->hasOne('PocketByR\Cliente', 'id', 'idCliente');
    }
    public function ventasHechas(){
      return $this->hasMany('PocketByR\Venta', 'idFactura', 'id');
    }

    public function scopeFacturaVigenteMesa($query, $idMesa){
      return $query->where('factura.idMesa', $idMesa)->where('factura.estado','En Proceso');
    }

    public function scopeListar2($query, $idEmpresa){
         $query->where('factura.estado', 'En proceso')
                  ->join('venta', 'factura.id', '=', 'venta.idFactura');
          return $query->groupBy('factura.idMesa')
                  ->orderBy('venta.hora','ASC')
                  ->Where([
                    ['venta.estadoBartender', 'Por atender'],
                    ['venta.estadoMesero', '<>','Cancelado'],
                    ['factura.idEmpresa', $idEmpresa]
                    ]);
    }

    //Función para los reportes de las categorias más vendidas, hace un groupby por las categorias, suma todas las ventas y las ordena descendentemente para que la más vendida quede arriba y lo limita a 4
    public function scopeTodasLasVentas($query, $idEmpresa){
      return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idCategoria')
                    ->groupBy('idCategoria')
                    ->orderBy('total', 'DESC')
                    ->limit(4);
    }
    // función para los reportes de las categorias más vendidas, trae las ventas hechas entre una fecha específica
    public function scopeVentasEntreFechas($query,$idCategoria,$fechaInicio,$fechaFinal){
      return $query->where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFinal]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->where('categoria.id', $idCategoria);
                    //->select(DB::raw('SUM(`cantidad`) as total'),'idCategoria');
    }

    // Función para los reportes de los meseros que más han vendido, esto sería para todos los tiempo, si se queire se puede colocar un rango de fecha para acotar la busqueda
    public function scopeVentasMesero($query,$idEmpresa,$totalVentas){
      return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa]])
                          ->join('venta', 'factura.id', '=', 'venta.idFactura')
                          ->join('producto', 'venta.idProducto', '=', 'producto.id')
                          ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
                          ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idMesero','nombrePersona',DB::raw('((SUM(`precio`*`cantidad`)*100)/'.$totalVentas.') as porcentaje'))
                          ->groupBy('idMesero')
                          ->orderBy('total', 'DESC')
                          ->limit(10);
    }

    // Función para los reportes de los Bartender que más han vendido, esto sería para todos los tiempo, si se queire se puede colocar un rango de fecha para acotar la busqueda
    public function scopeVentasBartender($query,$idEmpresa,$totalVentas){
      return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa]])
                          ->join('venta', 'factura.id', '=', 'venta.idFactura')
                          ->join('producto', 'venta.idProducto', '=', 'producto.id')
                          ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
                          ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idBartender','nombrePersona',DB::raw('((SUM(`precio`*`cantidad`)*100)/'.$totalVentas.') as porcentaje'))
                          ->groupBy('idBartender')
                          ->orderBy('total', 'DESC')
                          ->limit(10);
    }



    // Función para los reportes de los Bartender que más han vendido, esto sería para todos los tiempo, si se queire se puede colocar un rango de fecha para acotar la busqueda
    public function scopeVentasCajero($query,$idEmpresa,$totalVentas){
      return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa]])
                          ->join('venta', 'factura.id', '=', 'venta.idFactura')
                          ->join('producto', 'venta.idProducto', '=', 'producto.id')
                          ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
                          ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idCajero','nombrePersona',DB::raw('((SUM(`precio`*`cantidad`)*100)/'.$totalVentas.') as porcentaje'))
                          ->groupBy('idCajero')
                          ->orderBy('total', 'DESC')
                          ->limit(10);
    }


    //la cantidad total de todas las ventas, productos por cantidad
    public function scopeTotalEnTodasLasVentas($query,$idEmpresa){
       return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa]])
                          ->join('venta', 'factura.id', '=', 'venta.idFactura')
                          ->join('producto', 'venta.idProducto', '=', 'producto.id')
                          ->select(DB::raw('SUM(`precio`*`cantidad`) as totalVentas'));
    }

    //Dinero de las Ventas de un día en concreto
    public function scopeVentaDelDia($query,$idEmpresa,$fecha){
      return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa]])
                ->whereDate('factura.fecha','=',$fecha)
                ->select(DB::raw('SUM(`total`) as totalVentas'));
    }

    //Cantidad de ventas hechas en un día en concreto
    public function scopeCantidadVentasDelDia($query,$idEmpresa,$fecha){
      return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa]])
                ->whereDate('factura.fecha','=',$fecha)
                ->join('venta', 'factura.id', '=', 'venta.idFactura')
                ->select(DB::raw('count(*) as cantidadVentas'));
    }


    //Dinero de las Ventas de una semana en concreto
    public function scopeVentaSemana($query,$idEmpresa,$fechaInicio){
      return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa],['factura.fecha','>=',$fechaInicio->startOfWeek()->toDateTimeString()],['factura.fecha','<',$fechaInicio->endOfWeek()]])
                ->select(DB::raw('SUM(`total`) as totalVentas'));
    }

    //Cantidad de ventas hechas en una semana en concreto
    public function scopeCantidadVentasSemana($query,$idEmpresa,$fechaInicio){
      //dd($fechaInicio->startOfWeek()->toDateTimeString(),$fechaInicio->endOfWeek());
      return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa],['factura.fecha','>=',$fechaInicio->startOfWeek()->toDateTimeString()],['factura.fecha','<',$fechaInicio->endOfWeek()]])
                ->join('venta', 'factura.id', '=', 'venta.idFactura')
                ->select(DB::raw('count(*) as cantidadVentas'));
    }

    //Venta de cada día se la semana, de una semana concreta
    public function scopeVentaCadaDiaSemana($query,$idEmpresa,$fechaInicio){
      return $query->where([['factura.estado', 'Finalizada'],['factura.idEmpresa', $idEmpresa],['factura.fecha','>=',$fechaInicio->startOfWeek()->toDateTimeString()],['factura.fecha','<',$fechaInicio->endOfWeek()]])
                ->select(DB::raw('SUM(`total`) as totalVentas'),DB::raw('DAYNAME(`factura`.`fecha`) as dia'))
                ->groupBy(DB::raw('DAY(`factura`.`fecha`)'));
    }

    public function scopeListar($query, $idEmpresa){
      return $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
                   ->where([
                    ['factura.estado', 'En proceso'],
                    ['factura.idEmpresa', $idEmpresa]
                    ])
                   ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'factura.estado');

    }
    public function scopeBuscarMesaEnProceso($query, $arreglo){
      $nombreMesa = $arreglo[0];
      $idEmpresa = $arreglo[1];
      $query->where('factura.estado','En proceso');
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where([
                    ['nombreMesa','LIKE',"%$nombreMesa%"],
                    ['factura.idEmpresa', $idEmpresa]
                    ])
            ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'factura.estado');
      return $query;
    }
    public function scopeBuscarMesa($query, $arreglo){
      $nombreMesa = $arreglo[0];
      $idEmpresa = $arreglo[1];
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where([
                    ['nombreMesa','LIKE',"%$nombreMesa%"],
                    ['factura.idEmpresa', $idEmpresa]
                    ])
            ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'factura.estado');
      return $query;
    }

    public function scopeActualizarValor($query, $request){
        $query->where('factura.id', "$request->idFactura")
          ->update(['factura.total' => "$request->valor"]);
    }
    public function scopeActualizarFactura($query, $id){
        $query->where('factura.id', "$id")
          ->update(['factura.estado' => "Finalizada"]);
    }

    public function scopeBuscarFacturaId($query, $idMesa){
      $query->where('factura.estado','En proceso');
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where('mesa.id', $idMesa)
            ->select('factura.id as id');
      return $query;
    }

    public function scopelistarFacturaDia($query, $idEmpresa){
      $AnhoMes=date("Y-m");
      $dia = date("d");
      $hora = date("G");
      $aux = 0;
      if($hora >= 18){
        $aux = $dia+1;
        $query->where('factura.idEmpresa', $idEmpresa)
          ->whereBetween('fecha', [ "$AnhoMes-$dia 18:00:00.000000", "$AnhoMes-$aux 06:00:00.000000"])
          ->select("id");
        return $query;
      }
      else{
        $aux = $dia-1;
        $query->where('factura.idEmpresa', $idEmpresa)
           ->whereBetween('fecha', [ "$AnhoMes-$aux 18:00:00.000000", "$AnhoMes-$dia 06:00:00.000000"])
          ->select("id");
        return $query;
      }

    }
   public function scopeBuscarFacturas($query, $idEmpresa){
        $query->where('factura.idEmpresa', $idEmpresa)
              ->where('factura.estado','En proceso');
        return $query;
      }
    public function scopeListarTodas($query, $idEmpresa){
        $query->where('factura.idEmpresa', $idEmpresa)
        ->where('factura.estado','Finalizada');
        return $query;
    }
}