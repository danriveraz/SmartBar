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
/*Daniel*/
use PocketByR\Empresa;
use PocketByR\Notificaciones;
use Carbon\Carbon;
use PocketByR\User;
/*Fin Daniel*/
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
        $mesas = Mesa::mesasAdmin(Auth::user()->empresaActual)->get();
        $categorias = Categoria::categoriasEmpresa(Auth::user()->empresaActual)->get();
        $obsequio = Auth::user()->obsequio;
        return view('Mesero.index')->with('mesas',$mesas)->with('categorias',$categorias)->with('obsequio',$obsequio);
    }

    public function factura(Request $request){
        /*Daniel*/
        $empresa = Empresa::find(Auth::user()->empresaActual);
        /*Fin Daniel */
        $idMesa = $request->idM;
        $busqueda = Factura::buscarFacturaId($idMesa)->get()->last();

      if(sizeOf($busqueda) > 0){
        $ventas = Venta::pedidoProductos($busqueda->id)->get();
        $respuesta[] = array(
        'validacion' => true,
        'idFactura' => $busqueda->id,
        'ventas' => $ventas
        );
        return json_encode($respuesta);
      }else{
        $nfactura = new Factura;
        $nfactura->estado = "En proceso";
        $nfactura->fecha = date("Y-m-d H:i:s", time());
        $nfactura->total = 0;
        $nfactura->idEmpresa = Auth::user()->empresaActual;
        $nfactura->idUsuario = Auth::user()->id;
        $nfactura->idMesa = $idMesa;
        /*Daniel*/
        $nfactura->idBar = $empresa->contadorFactura;
        /*Fin Daniel*/
        $nfactura->save();
        $factura = Factura::buscarFacturaId($idMesa)->get()->last();
        $respuesta[] = array(
         'validacion' => false,
         'idFactura' => $factura->id
        );
        return json_encode($respuesta);
      }
    }

    public function contiene(Request $request){
        $producto = Producto::find($request->idP);
        $contiene = $producto->contienen;
        $insumos = [];
        foreach ($contiene as $unidad) {
          array_push($insumos, $unidad->insumo);
        }
        $respuesta[] = array(
          'nombre' => $producto->nombre,
          'receta' => $producto->receta,
          'contiene' => $contiene,
          'insumos' => $insumos
        );
        return json_encode($respuesta);
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
      $empresa = Empresa::find(Auth::user()->empresaActual);
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
              /*Daniel -> cambio de "date("Y-m-d H:i:s", time());" por Carbon::now()*/
              $nuevaVenta->hora = Carbon::now();
              /*Fin Daniel*/
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
          flash::success('El pedido se ha modificado satisfactoriamente.')->important();
        }else{
          for($i=0; $i<$size; $i++){
            $venta = new Venta;
            $venta->cantidad = $cantidades[$i];
            /*Daniel -> cambio de "date("Y-m-d H:i:s", time());" por Carbon::now()*/
            $venta->hora = Carbon::now();
            /*Fin Daniel*/
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

          /*Daniel*/
          $empresa->contadorFactura = $empresa->contadorFactura + 1;
          $diferencia = $empresa->nFin - $empresa->contadorFactura;
          $usuarios = User::SearchUsers(Auth::user()->empresaActual)->get();

          if($diferencia == 100 || $diferencia == 50){
            for ($i=0; $i < sizeof($usuarios); $i++) { 
              $notificacion = new Notificaciones();
              $notificacion->estado = "nueva";
              $notificacion->descripcion = "¡Facturación próxima a agotarse!";
              $notificacion->ruta = "Perfil";
              $notificacion->fecha = Carbon::now();
              $idEmpresa = $empresa->id;
              $idUsuario = $usuarios[$i]->id;
              $notificacion->save();
            }
          }
          
          if($empresa->tipoRegimen == "comun"){
            if($empresa->nresolucionFacturacion != "" || $empresa->fechaResolucion != "0000-00-00" || $empresa->imagenResolucionFacturacion != "" || $empresa->nInicio != 0 || $empresa->nFinal == 0){
              $empresa->save();
            }
          }
          /*Fin Daniel*/

          flash::success('El pedido se ha creado satisfactoriamente')->important();
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
