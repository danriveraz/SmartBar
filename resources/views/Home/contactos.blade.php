@extends('Layout.app_principales')
@section('content')

{!!Html::style('assetsNew/styles/style-Contact.css')!!}

<!-- CONTACTO (ENCABEZADO) -->
<section class="block bg-green gap-top-contact" data-name="ContactHead">
    <div class="block-content no-pad">
        <div class="head-small ">        
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        <div class="hide-mobile">
          <img class="head-small-icon" src="assetsNew/images/head-character.png" alt="¿Tienes dudas?" title="Soporte">
          <div class="head-small-text">
            <h3 class="serif margin-tiny">¿Tienes dudas?</h3>
            <p class="serif margin-tiny">Como tu amigo inseparable, siempre estamos presente para brindarte la mejor asesoria, darte un consejo y solucionar cualquier inquietud o inconveniente, es <span class="bold">Gratis</span>, e Ilimitado.</p>
          </div>
          </div>
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        </div>
    </div>
</section>

<!-- CONTACTO -->
<section class="block" data-name="Contact">
    <div class="block-content">
        <h2 class="hide">Contacto</h2>
        <div class="row">
            <div class="col">
                <!-- Formulario -->

  <div class="login-01">
      <form>
        <ul>
        <li class="first">
          <a href="#" class=" icon user"></a><input type="text" class="text" value="Nombre" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nombre';}" >
          <div class="clear"></div>
        </li>
        <li class="first">
          <a href="#" class=" icon email"></a><input type="text" class="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" >
          <div class="clear"></div>
        </li>
        <li class="first">
          <a href="#" class=" icon phone"></a><input type="text" class="text" value="Telefono" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Telefono';}" >
          <div class="clear"></div>
        </li>
        <li class="second">
        <a href="#" class=" icon msg"></a><textarea  value="Mensaje" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mensaje';}"></textarea>
        <div class="clear"></div>
        </li>
      </ul>
      <input type="submit" onclick="myFunction()" value="Enviar" >
      <div class="clear"></div>
    </form>
</div>





            </div>
            <div class="col">
                <!-- Preguntas frecuentes -->
                <h3 class="serif text-green">¿Tienes mas duas?</h3>
                <div class="js-Accordion" >
                    <!-- Pregunta 1 -->
                    <div class="accordion-content">
                        <p>nuestro equipo esta calificado para responder todas tus dudas al respecto envianos un correo</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- SOPORTE  -->
<section class="block " data-name="Support">
    <div class="block-content no-pad text-center">
      <h2 class="">¡SmartBar te Asesora!</h2>
      <h4 class="margin-tiny text-Morado">Si necesitas ayuda contáctanos en <a class=" text-gris" rel="alternate">Nuestro chat en linea</a></h4>

 <hr>
    <h4 class="text-gris">Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas. <a href="" target="_blank" rel="alternate">¿Que es PocketClub?</a></h4>
    <hr>

    </div>



</section>

   

<!-- REGISTRO -->
<section class="block" data-name="Register">
    <div class="block-content text-center">
        <h2 class="margin-tiny">Empieza tus <strong>7 Dias gratis</strong></h2>
        <h4 class="margin-tiny">Prueba todas las características de SmartBar sin limitaciones</h4>
      <p><a class="button large" href="{{ url('Auth/register') }}" rel="alternate"><strong>INGRESA YA!</strong></a></p>
    </div>
</section>


<!-- PIE DE PÁGINA -->

@endsection