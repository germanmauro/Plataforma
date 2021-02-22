<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Meeting;
use App\Models\Publication;
use App\Models\RegistroDias;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
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
            $diasOcupados =
            DB::table('meetings')
                ->join('buys', 'buys.id', '=', 'meetings.buy_id')
                ->join('publications', 'publications.id', '=', 'buys.publication_id')
                ->join('users', 'users.id', '=', 'publications.user_id')
                ->select('fecha')
                ->where('users.id', "=", $publicacion->user_id)
                ->where('fecha', ">", $hoy->format('Y-m-d'))
                ->get();

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
                            if(!$diasOcupados->where("fecha","=", $diadesde->format('Y-m-d H:i:s'))->count())
                            {
                                $itemdia = new RegistroDias();
                                $itemdia->id = $diadesde->format('Y-m-d H:i');
                                $itemdia->descripcion = $item->dia . " " . $diadesde->format('d/m/Y H:i');
                                $dias[] = $itemdia;
                            }
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
        $cantindad = DB::table('meetings')
        ->join('buys', 'buys.id', '=', 'meetings.buy_id')
        ->join('publications', 'publications.id', '=', 'buys.publication_id')
        ->join('users', 'users.id', '=', 'publications.user_id')
        ->whereIn("fecha",$request->dias)->count();
        if(!$cantindad) {
            $buy = new Buy();
            $buy->publication_id = $publicacion->id;
            $buy->user_id = session("Id");
            $buy->save();
            foreach ($request->dias as $dia) {
                $meeting = new Meeting();
                $meeting->fecha = $dia;
                $buy->meetings()->save($meeting);
            }
        }
        else 
        {
            return Redirect::back()->with('error','Alguna de las fechas ya está utilizada. Vuelva a elegir las fechas de sus clases');
        }
    
        return Redirect::route("paypal",compact('buy'));
    }
}
