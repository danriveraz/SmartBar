<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Mesa;
use PocketByR\Producto;
use PocketByR\Categoria;
use PocketByR\Factura;
use PocketByR\Contiene;
use PocketByR\Venta;
use Laracasts\Flash\Flash;

class MeseroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $mesas = Mesa::all();
        return view('mesero.mesas')->with('mesas',$mesas);
    }

    public function agregar(Request $request){
      $producto = Producto::find($request->idP);

      $contenido = Contiene::idProducto($request->idP)->paginate(20);
      $auxiliar = 0;

      foreach($contenido as $contiene){
          $cantidadNecesaria = $contiene->cantidad;
          $insumo = $contiene->insumo;
          $cantidadRestante = $insumo->cantidadRestante - $cantidadNecesaria;
          $unidades = $insumo->cantidadUnidad;

          if($cantidadRestante <= 0 && $unidades > 1){
            $insumo->cantidadRestante = $insumo->cantidadMedida + $cantidadRestante;
            $insumo = $insumo->cantidadUnidad - 1;
            $insumo->save();
            $auxiliar = $auxiliar+1;
          }elseif($cantidadRestante > 0){
            $insumo->cantidadRestante = $cantidadRestante;
            $insumo->save();
            $auxiliar = $auxiliar+1;
          }
      }

      if($auxiliar == sizeOf($contenido) && sizeOf($contenido) != 0){
        return json_encode($producto);
      }else{
        $request->session()->flash('error_msg', 'El producto se encuentra agotado.');
        $producto = null;
        return json_encode($producto);
      }

    }

    public function disminuir(Request $request){
      $producto = Producto::find($request->idP);

      $contenido = Contiene::idProducto($request->idP)->paginate(20);

      foreach($contenido as $contiene){
          $cantidadNecesaria = $contiene->cantidad;
          $insumo = $contiene->insumo;
          $nuevaCantidad = $insumo->cantidadRestante + $cantidadNecesaria;
          $unidades = $insumo->cantidadUnidad;

          if($nuevaCantidad > $insumo->cantidadMedida){
            $insumo->cantidadRestante = $nuevaCantidad - $insumo->cantidadMedida;
            $insumo = $insumo->cantidadUnidad + 1;
            $insumo->save();
          }else{
            $insumo->cantidadRestante = $nuevaCantidad;
            $insumo->save();
          }
      }
    }

    public function venta(Request $request){
      $productos = $request->productosTabla;
      $cantidades = $request->cantidadesTabla;
      $idFactura = $request->factura;
      $idMesa = $request->mesa;

      $size = sizeOf($productos);

      if($size != 0){
        for($i=0; $i<$size; $i++){
          $venta = new Venta;
          $venta->cantidad = $cantidades[$i];
          $venta->hora = date("Y-m-d H:i:s", time());
          //$venta->estadoMesero = '';
          $venta->estadoBartender = 'Por atender';
          $venta->estadoCajero = '0';
          $venta->idFactura = $idFactura;
          $venta->idProducto = $productos[$i];
          $venta->idMesero = 1; //Cambiar
          $venta->idBartender = 1; //Cambiar
          $venta->save();
        }
        $mesa = Mesa::find($idMesa);
        $mesa->estado = 'Ocupada';
        $mesa->save();

        $request->session()->flash('success_msg', 'El registro del pedido se ha realizado satisfactoriamente.');
      }
      
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mesa = Mesa::find($id);
        $categorias = Categoria::all();
        $busqueda = Factura::buscarFacturaId($id)->paginate(20);
        if(sizeOf($busqueda) > 0){
          return view('mesero.venta')->with('facturas',$busqueda)->with('mesa',$mesa)->with('categorias',$categorias);
        }else{
          $nfactura = new Factura;
          $nfactura->estado = "En proceso";
          $nfactura->total = 0;
          $nfactura->fecha = date("Y-m-d H:i:s", time());
          $nfactura->idAdmin = 1; //Cambiar
          $nfactura->idUsuario = 1; //Cambiar
          $nfactura->idMesa = $mesa->id;
          $nfactura->save();
          $facturas = Factura::buscarFacturaId($id)->paginate(20);
          return view('mesero.venta')->with('facturas',$facturas)->with('mesa',$mesa)->with('categorias',$categorias);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
