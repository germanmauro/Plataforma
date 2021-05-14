@extends('layouts.info')
@section('content')
<link href="{{ asset('css/accordion.css') }}" rel="stylesheet">
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>
                	FAQ
                </h3>
                <h4>www.capacitacionee.com</h4>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="accordion">
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Cómo me inscribo en C.E.E?
                              </div>
                              <div class="accordion__item__content">
                                 La inscripción se efectúa insertando los datos personales y validando el e-mail.
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Cuánto cuesta la inscripción en C.E.E?
                              </div>
                              <div class="accordion__item__content">
                                 Registrarse es gratuito tanto para alumnos y profesores.
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Quién puede acceder a nuestros cursos?
                              </div>
                              <div class="accordion__item__content">
                                 Nuestros cursos están dirigidos a niños a partir de los cinco años, 
                                 adolescentes y adultos. Los mismos están divididos por edades.
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Cuál es el valor de cada curso?
                              </div>
                              <div class="accordion__item__content">
                                 La primera clase del alumno en la plataforma será gratuita.
                                Solo pagará cuando decida contratar una clase o un curso. 
                                El precio se encuentra siempre visible al momento de cada compra.
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Cómo accedo a comprar una clase o un curso?
                              </div>
                              <div class="accordion__item__content">
                                 Para comprar una clase o un curso, el cliente debe estar registrado. 
                                Lo primero es buscar la clase o el curso que se desea adquirir, 
                                luego elegir la fecha de inicio y el horario deseado, luego aceptar los términos y condiciones y la política de privacidad, por ultimo seleccionar comprar.
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Cuál es el medio de pago?
                              </div>
                              <div class="accordion__item__content">
                                 El medio de pago de nuestra plataforma es a través de la pasarela de pagos 
                                 Paypal con todas las tarjetas de crédito y Débito. Las compras se realizan 
                                 desde nuestro sitio web en línea.
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Cómo funcionan las clases?
                              </div>
                              <div class="accordion__item__content">
                                 Las clases se realizan a través de Google Meet. C.E.E enviará el Link 
                                 para conectar al alumno/s con el profesor para cada clase. 
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Cuales son los requisitos para cada clase?
                              </div>
                              <div class="accordion__item__content">
                                  Todas las clases son en vivo. Aconsejamos configurar una cuenta de correo Gmail, para que 
                                  puedas tener todas las clases organizadas en el calendario de Google. El alumno podrá utilizar
                                   cualquier dispositivo de su elección. (Celular, Tablet u ordenador) C.E.E funciona en 
                                   los principales navegadores web y utilizamos Google Meet para las 
                                  clases en vivo. Necesitará una web cam (Opcional), un micrófono y conexión a Internet.  
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Cómo acceder a las clases online?
                              </div>
                              <div class="accordion__item__content">
                                Al Momento de cada compra C.E.E enviará a través del correo electrónico (Gmail) que el alumno y
                                 el profesor insertaron al momento del registro, el Link de todas las clases del curso comprado, 
                                 de este modo todas las clases quedarán almacenadas
                                 y programadas en el calendario de Google, el cual les recordará media hora antes de cada clase.
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Que sucede si no cuento con un correo electrónico GMAIL?
                              </div>
                              <div class="accordion__item__content">
                                Aunque si nosotros lo aconsejamos, no hay ningún problema, C.E.E podrá enviar el Link para el
                                 acceso a cada clase a través de una notificación en el
                                 account del alumno/s y del profesor o al e-mail que entregó al momento de la registración.
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Que sucede si no puedo asistir a una clase?
                              </div>
                              <div class="accordion__item__content">                                  
                                La clase será reprogramada teniendo en cuenta la disponibilidad del profesor,
                                 sólo si el alumno avisa 48 hs. antes del inicio de la clase a través del
                                  e-mail info@capacitacionee.com. De lo contrario el alumno perderá la misma. 
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Que sucede si el profesor no puede asistir a una clase?
                              </div>
                              <div class="accordion__item__content">                                  
                                Si el Profesor por motivos personales o de salud no puede asistir a una clase, el alumno será comunicado a través de un e-mail por parte de C.E.E (Capacitación en Español) en donde se comunicará la fecha de la reprogramación de dicha clase. 
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Que sucede si el curso Grupal no tiene el número de alumnos mínimos requeridos inscriptos? 
                              </div>
                              <div class="accordion__item__content">                                  
                                En el caso de los cursos grupales donde no se encuentren inscriptos el mínimo de alumnos requeridos, será el profesor el que decida si llevar a cabo el curso, cambiar de fecha el curso o bien, cancelar el curso. Cualquiera de estas opciones serán comunicadas desde la plataforma a los alumnos o padres vía e-mail.
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Qué sucede si me arrepiento de la compra del curso?
                              </div>
                              <div class="accordion__item__content">
                                <p>Para cursos cortos en relación al tiempo de cursada, con el numero de clases definidas, el cliente dispondrá de un plazo máximo de 14 días naturales desde el día de la inscripción, para informar a CEE (Capacitación en español) sobre su deseo de desistir del contrato, siempre que el curso no se inicie durante ese plazo.</p>
                                <p>El desistimiento implica que, CEE (Capacitación en español) procederá a la devolución del importe ya abonado por el cliente en un plazo máximo de 14 días naturales, siguiendo el mismo procedimiento elegido por el cliente para su abono. </p>
                                <p>Para cursos extensos en relación al tiempo de cursada, aquellos que son de abono mensual, el cliente tendrá derecho a DESISTIR del contrato en cualquier momento sin necesidad de indicar el motivo y sin incurrir en ningún costo.</p>
                                <p>En este caso el desistimiento no implica que, CEE (Capacitación en español) proceda a la devolución del importe ya abonado por el cliente.</p>
                                <p>Una vez recibamos su solicitud nos pondremos en contacto con el cliente para indicarle los detalles de la devolución.</p>
                              </div>
                          </div>
                          <div class="accordion__item">
                              <div class="accordion__item__header">
                                ¿Los cursos son de calidad?
                              </div>
                              <div class="accordion__item__content">
                                  Antes de la aceptación de cada profesor, C.E.E entrevista y selecciona 
                                  a aquellos profesores que tienen experiencia en la enseñanza, 
                                  conocimientos en la materia y una pasión única en su especialidad.
                              </div>
                          </div>
                        </div>

                    </div>

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/accordion.js') }}"></script>
@endsection