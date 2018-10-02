@extends('Layout.app_principales')
@section('content')

<section class="block bg-pocket gap-top-contact" data-name="ContactHead">
    <div class="block-content no-pad">
        <div class="head-small">        
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        <div class="hide-mobile">
          <img class="head-small-icon" src="{{asset('assets-home/images/head-character.png')}}" alt="¿Tienes dudas?" title="Soporte">
          <div class="head-small-text">
            <h3 class="roboto1 white margin-tiny">Contactarte con tu amigo inseparable es muy fácil</h3>
            <p class=" margin-tiny">Puedes contactarnos mediante nuestro correo electronico, aseguramos tener una respuesta en las siguientes 8 horas, en otros casos consideraremos llamarte.</p>
          </div>
          </div>
        <!-- div que esconde vista para mobiles--> 
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
            <div class="col contac-Pocket">
                <!-- Preguntas frecuentes -->
                <h3 class="roboto1 pocket-color ">¿Tienes dudas?</h3>
          <P class="">Más opciones para que te contactes con tu amigo inseparable SMARTBAR.</P>
                <div class="js-Accordion" >
                    <!-- Pregunta 1 -->
                    <div class="accordion-content">
                        <p>Teléfono 225 8819</p>
                        <p>Celular 315 627 1238 - 318 281 1441</p>
                        <p>Carrera 26 No. 28-31 Ofic. 102 / Tuluá - Valle del Cauca</p>
                        <p>smartbar@gmail.com</p>
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
        </div>
</section>
<!-- 7 dias gratos -->
<section class="block" data-name="Plans">
  <div class="block-content text-center">
    <h2 class="margin-tiny">Empieza tus <strong>7 Días GRATIS</strong></h2>    
    <p><img class="plan-payment" src="{{asset('assets-home/images/logos-payment-col-pocket.png')}}" alt="Métodos de pago"/></p>
    <p><a class="button large" href="https://pocketsmartbar.com/Auth/register" rel="alternate"><strong>UNITE A POCKETCLUB</strong></a></p>
    <hr>
  <div class="pocket">
    <h4>Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas. <a href="" target="_blank" rel="alternate">¿Que es PocketClub?</a></h4></div>
    <hr>
  </div>
</section>


<!-- PIE DE PÁGINA -->

@endsection