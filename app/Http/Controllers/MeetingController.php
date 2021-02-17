<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\RegistroDias;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MeetingController extends Controller
{
    //Comprar
    public function comprar($id, $slug = "")
    {
        if (!session()->has('Perfil') || session("Perfil") != "alumno") {
            return Redirect::back()->with('warning', 'Debe registrarse como alumno para poder comprar cursos');
        }
        else
        {
            //obtengo la publicacion
            $publicacion = Publication::find($id);
            //Al día de hoy le sumo un día
            $hoy = new DateTime();
            $hoy->add(new DateInterval("P1D"));
            $dias = array();
            //Relación dia de semana
            $diaSemana = [
                "Lunes" => "Monday",
                "Martes" => "Tuesday",
                "Miercoles" => "Wednesday",
                "Jueves" => "Thursday",
                "Viernes" => "Friday",
                "Sabado" => "Saturday",
                "Domingo" => "Sunday"
            ];
            
            while(count($dias)<=30) {
                $hoy->add(new DateInterval("P1D"));
                foreach ($publicacion->user->availabilities as $item) {
                    
                    // $diahasta = $diahasta->add(new DateInterval("PT1H"));
                    if($hoy->format("l") == $diaSemana[$item->dia])
                    {
                        //Si el día es un dia que el profesor puede
                        $diadesde = new DateTime($hoy->format('Y-m-d ' . $item->desde));
                        $diahasta = (new DateTime($hoy->format('Y-m-d ' . $item->hasta)))->sub(new DateInterval("PT1H"));
                        $desde = $item->desde;
                        while ($diadesde <= $diahasta) {
                            $itemdia = new RegistroDias();
                            $itemdia->id = $diadesde->format('Y-m-d H:i');
                            $itemdia->descripcion = $item->dia. " ".$diadesde->format('d/m/Y H:i');
                            $dias [] = $itemdia;
                            $diadesde->add(new DateInterval("PT1H"));
                        }
                    }
                }
            }

            return view("cursos.comprar", compact("publicacion","dias"));
        }   
    }

    //Comprar la clase
    public function create(Publication $publicacion, Request $request)
    {
        return $request;

        return redirect("/Categoria")->with("success", "Registro actualizado correctamente");;
    }
}
