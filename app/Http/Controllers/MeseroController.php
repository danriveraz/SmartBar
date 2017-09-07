<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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

     public function __construct()
     {
       $this->middleware('auth');
       $userActual = Auth::user();
        if($userActual != null){
           if (!$userActual->esMesero) {
               flash('No tiene los permisos necesarios')->error()->important();
               return redirect('/WelcomeTrabajador')->send();
           }
        }
     }

    public function index()
    {
        $mesasDisponibles = Mesa::mesasAdminDisponibles(Auth::user()->idEmpresa)->get();
        $mesasOcupadas =  Mesa::mesasAdminOcupadas(Auth::user()->idEmpresa)->get();
        $mesasReservadas =  Mesa::mesasAdminReservadas(Auth::user()->idEmpresa)->get();
        $cantidad = 0;
        if(sizeOf($mesasDisponibles) > 0){
          $cantidad = $cantidad+1;
        }
        if(sizeOf($mesasOcupadas) > 0){
          $cantidad = $cantidad+1;
        }
        if(sizeOf($mesasReservadas) > 0){
          $cantidad = $cantidad+1;
        }
        return view('Mesero.mesas')->with('mesasDisponibles',$mesasDisponibles)->with('mesasOcupadas',$mesasOcupadas)
        ->with('mesasReservadas',$mesasReservadas)->with('cantidad',$cantidad);
    }

    public function agregar(Request $request){
      $producto = Producto::find($request->idP);
      $contenido = Contiene::idProducto($request->idP)->get();
      $auxiliar = 0;

      foreach($contenido as $contiene){
          $cantidadNecesaria = $contiene->cantidad;
          $insumo = $contiene->insumo;
          $cantidadRestante = $insumo->cantidadRestante - $cantidadNecesaria;
          $unidades = $insumo->cantidadUnidad;

          if($cantidadRestante == 0 && $unidades > 1){
            $auxiliar = $auxiliar+1;
          }elseif($cantidadRestante == 0 && $unidades == 1){
            $auxiliar = $auxiliar+1;
          }elseif($cantidadRestante < 0 && $unidades > 1){
            $auxiliar = $auxiliar+1;
          }elseif($cantidadRestante > 0){
            $auxiliar = $auxiliar+1;
          }
      }

      if($auxiliar == sizeOf($contenido) && sizeOf($contenido) != 0){
        foreach($contenido as $contiene){
            $cantidadNecesaria = $contiene->cantidad;
            $insumo = $contiene->insumo;
            $cantidadRestante = $insumo->cantidadRestante - $cantidadNecesaria;
            $unidades = $insumo->cantidadUnidad;

            if($cantidadRestante == 0 && $unidades > 1){
              $insumo->cantidadRestante = $insumo->cantidadMedida;
              $insumo->cantidadUnidad = $insumo->cantidadUnidad - 1;
              $insumo->save();
            }elseif($cantidadRestante == 0 && $unidades == 1){
              $insumo->cantidadRestante = $cantidadRestante;
              $insumo->cantidadUnidad = $insumo->cantidadUnidad - 1;
              $insumo->save();
            }elseif($cantidadRestante < 0 && $unidades > 1){
              $insumo->cantidadRestante = $insumo->cantidadMedida + $cantidadRestante;
              $insumo->cantidadUnidad = $insumo->cantidadUnidad - 1;
              $insumo->save();
            }elseif($cantidadRestante > 0){
              $insumo->cantidadRestante = $cantidadRestante;
              $insumo->save();
            }
        }
        return json_encode($producto);

      }else{
        $request->session()->flash('error_msg', 'El producto se encuentra agotado.');
        $producto = null;
        return json_encode($producto);
      }

    }

    public function disminuir(Request $request){

      $producto = Producto::find($request->idP);
      $obs = $request->obsequiar;

      if($request->cant == 0){
        $ventas = Venta::pedidoActualMesa($request->idF)->get();
        if(sizeOf($ventas) > 0){
          foreach($ventas as $venta){
            if($venta->idProducto == $producto->id && $venta->obsequio == $obs){
              $venta->estadoMesero = 'Cancelado';
              $venta->save();
            }
          }
        }
      }

      $contenido = Contiene::idProducto($request->idP)->get();

      foreach($contenido as $contiene){
          $cantidadNecesaria = $contiene->cantidad;
          $insumo = $contiene->insumo;
          $nuevaCantidad = $insumo->cantidadRestante + $cantidadNecesaria;
          $unidades = $insumo->cantidadUnidad;

          if($nuevaCantidad > $insumo->cantidadMedida){
            $insumo->cantidadRestante = $nuevaCantidad - $insumo->cantidadMedida;
            $insumo->cantidadUnidad = $insumo->cantidadUnidad + 1;
            $insumo->save();
          }elseif($insumo->cantidadRestante == 0){
            $insumo->cantidadRestante = $nuevaCantidad;
            $insumo->cantidadUnidad = $insumo->cantidadUnidad + 1;
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
      $totales = $request->totalesTabla;
      $idFactura = $request->factura;
      $idMesa = $request->mesa;
      $ventas = Venta::pedidoActualMesa($idFactura)->get();

      $size = sizeOf($productos);
      $sizeVenta = sizeOf($ventas);

      if($size != 0){
        if($sizeVenta != 0){

          for($i=0; $i<$size; $i++){
            $auxiliar = false;
            foreach($ventas as $venta){
              if($venta->idProducto == $productos[$i] && $venta->cantidad != $cantidades[$i] && $venta->obsequio == $totales[$i]){
                $auxiliar = true;
                $venta->cantidad = $cantidades[$i];
                $venta->save();
              }elseif($venta->idProducto == $productos[$i] && $venta->cantidad == $cantidades[$i] && $venta->obsequio == $totales[$i]){
                $auxiliar = true;
              }
            }

            if($auxiliar == false){
              $nuevaVenta = new Venta;
              $nuevaVenta->cantidad = $cantidades[$i];
              $nuevaVenta->hora = date("Y-m-d H:i:s", time());
              $nuevaVenta->estadoMesero = 'Vigente';
              $nuevaVenta->estadoBartender = 'Por atender';
              $nuevaVenta->estadoCajero = '0';
              $nuevaVenta->idFactura = $idFactura;
              $nuevaVenta->idProducto = $productos[$i];
              $nuevaVenta->obsequio = $totales[$i];
              $nuevaVenta->idMesero = Auth::user()->id;
              $nuevaVenta->idBartender = Auth::user()->id;
              $nuevaVenta->idCajero = Auth::user()->id;
              $nuevaVenta->save();
            }

          }
          $request->session()->flash('success_msg', 'El pedido se ha modificado satisfactoriamente.');
        }else{
          for($i=0; $i<$size; $i++){
            $venta = new Venta;
            $venta->cantidad = $cantidades[$i];
            $venta->hora = date("Y-m-d H:i:s", time());
            $venta->estadoMesero = 'Vigente';
            $venta->estadoBartender = 'Por atender';
            $venta->estadoCajero = '0';
            $venta->idFactura = $idFactura;
            $venta->idProducto = $productos[$i];
            $venta->obsequio = $totales[$i];
            $venta->idMesero = Auth::user()->id;
            $venta->idBartender = Auth::user()->id;
            $venta->idCajero = Auth::user()->id;
            $venta->save();
          }
          $mesa = Mesa::find($idMesa);
          $mesa->estado = 'Ocupada';
          $mesa->save();

          $request->session()->flash('success_msg', 'El registro del pedido se ha realizado satisfactoriamente.');
        }
      }else{
        $request->session()->flash('error_msg', 'Deben agregarse productos para completar el pedido');
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
      $categorias = Categoria::categoriasEmpresa(Auth::user()->idEmpresa)->get();
      $busqueda = Factura::buscarFacturaId($id)->get()->last();
      $obsequiar = Auth::user()->obsequio;
      $ventas = null;

      if(sizeOf($busqueda) > 0){
        $ventas = Venta::pedidoActualMesa($busqueda->id)->get();
        return view('Mesero.venta')->with('factura',$busqueda)->with('mesa',$mesa)->with('categorias',$categorias)->with('ventas',$ventas)->with('obsequiar', $obsequiar);
      }else{
        $nfactura = new Factura;
        $nfactura->estado = "En proceso";
        $nfactura->fecha = date("Y-m-d H:i:s", time());
        $nfactura->total = 0;
        $nfactura->idEmpresa = Auth::user()->idEmpresa; //Cambiar?
        $nfactura->idUsuario = Auth::user()->id; //Cambiar?
        $nfactura->idMesa = $id;
        $nfactura->save();
        $facturas = Factura::buscarFacturaId($id)->get()->last();
        return view('Mesero.venta')->with('factura',$facturas)->with('mesa',$mesa)->with('categorias',$categorias)->with('ventas',$ventas)->with('obsequiar', $obsequiar);
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
