@extends('Layout.app_principales')
@section('content')

<section class="block bg-pocket gap-top-contact" data-name="ContactHead">
    <div class="block-content no-pad">
        <div class="head-small">        
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        <div class="hide-mobile">
          <img class="head-small-icon" src="{{asset('assets-home/images/head-character.png')}}" alt="¿Tienes dudas?" title="Soporte">
          <div class="head-small-text">
            <h3 class="roboto1 white margin-tiny">¿Tienes dudas?</h3>
            <p class=" margin-tiny">Como tu amigo inseparable, siempre estamos presente para brindarte la mejor asesoria, darte un consejo y solucionar cualquier inquietud o inconveniente, es <span class="bold">Gratis</span>, e Ilimitado.</p>
          </div>
          </div>
        <!-- div que esconde cuando es muy chiquito para mobiles-->
        </div>
    </div>
</section>
<!-- PREGUNTAS FRECUENTES -->
<section class="block" data-name="Faqs">
    <div class="block-content">
        <h2 class="text-center">Terminos y Condiciones</h2>
        <div class="row cards-basic bg-white">
            <div class="col bg-gray-white">
                <div>
                    <h3 class="text-green margin-tiny">1.Politicas de Privacidad</h3>
        			<p style="text-align:justify">
                    La presente Política de Privacidad establece los términos en que Pocket Compañy usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.
					<br>
	                Información que es recogida en nuestro sitio web podrá tener información personal por ejemplo: Nombre,  información de contacto como  su dirección de correo electrónica e información demográfica. Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún pedido o realizar una entrega o facturación.</p>
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">2. Uso de la Información</h3>
                    <p style="text-align:justify">                   	
	                Uso de la información recogida en nuestro sitio web, emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios.  Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, nuevos productos y otra información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.<br>

	                    	
	                Pocket Compañy está altamente comprometido para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.</p>	               
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">3. Uso de Cookies</h3>
                    <p style="text-align:justify">                   	
	                Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.

	                Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente. Usted puede aceptar o negar el uso de cookies, sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.</p>	               
                    <hr>
                </div>
                <div>
                    <h3 class="text-green margin-tiny">4. Enlaces a terceros</h3>
                    <p style="text-align:justify">                   	
	                este sitio web pudiera contener en laces a otros sitios que pudieran ser de su interés. Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.</p>	               
                    <hr>
                </div>				
                <div>
                    <h3 class="text-green margin-tiny">5. Control de su información personal</h3>
                    <p style="text-align:justify">                   	
	                n cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web.  Cada vez que se le solicite rellenar un formulario, como el de alta de usuario, puede marcar o desmarcar la opción de recibir información por correo electrónico.  En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento.

	                Esta compañía no venderá, cederá ni distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.

	                Pocket Compañy Se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.
	                </p>	               
                    <hr>
                </div>				
				
				
				
				
				
				
            </div><!--col bg-gray-white-->            
        </div>
    </div>
</section>
<!-- 7 DIAS GRATIS-->
<section class="block" data-name="Plans">
  <div class="block-content text-center" style="padding-top: 0px;">
    <h2 class="margin-tiny">Empieza tus <strong>7 Dias gratis</strong></h2>    
    <p><img class="plan-payment" src="{{asset('assets-home/images/logos-payment-col-pocket.png')}}" alt="Métodos de pago"/></p>
    <p><a class="button large" href="http://pocketsmartbar.com/Auth/register" rel="alternate"><strong>UNIRSE A POCKETCLUB</strong></a></p>
    <hr>
	<div class="pocket">
    <h4>Al ser miembro PocketClub, obtienes descuentos, obsequios y promociones únicas. <a href="" target="_blank" rel="alternate">¿Que es PocketClub?</a></h4></div>
    <hr>
  </div>
</section>	

@endsection