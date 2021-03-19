<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notification;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\DB;

class CronController extends Controller
{
    //Alerta diario de clase para alumno y profesor
    public static function dairyClassAlert()
    {
        //Le agrego un día para que la envíe un día antes
        $hoy = new DateTime();
        $fecha = new DateTime();
        $fecha->add(new DateInterval("P1D"));
        $cursos = Course::where("cantidadalumnos", ">", 0)
        ->where("ultimaclase", ">", $hoy->format("Y-m-d H:i"))->get();
        foreach ($cursos as $item) {
            foreach ($item->diasActuales() as $dia) {
                if($dia->fecha->format('Y-m-d') == $fecha->format('Y-m-d') && !$dia->aviso1dia)
                {
                    //aviso a profesor
                    $not = new Notification();
                    $not->avisoClase($item->publication->user, $item, $dia->fecha);
                    //aviso a cada usuario
                    foreach ($item->users as $user) {
                        $not = new Notification();
                        $not->avisoClase($user,$item,$dia->fecha);
                    }
                    $dia->aviso1dia = true;
                    $dia->save();
                    break;
                }
            }
        }
    }

    //Alerta de 30 min antes de clase
    public static function thirtyMinClassAlert()
    {
        //Le agrego un día para que la envíe un día antes
        $hoy = new DateTime();
        $fecha = new DateTime();
        $fecha->add(new DateInterval("PT31M"));
        $cursos = Course::where("cantidadalumnos", ">", 0)
        ->where("ultimaclase", ">", $hoy->format("Y-m-d H:i"))->get();
        foreach ($cursos as $item) {
            foreach ($item->diasActuales() as $dia) {
                if ($dia->fecha->format('Y-m-d H:i') < $fecha->format('Y-m-d H:i') && !$dia->aviso30min) {
                    //aviso a profesor
                    $not = new Notification();
                    $not->avisoClase30min($item->publication->user, $item);
                    //aviso a cada usuario
                    foreach ($item->users as $user) {
                        $not = new Notification();
                        $not->avisoClase30min($user, $item);
                    }
                    $dia->aviso30min = true;
                    $dia->save();
                    break;
                }
            }
        }
    }

    //Actualizo cuotas actuales y fechas de los cursos
    public static function courseUpdate()
    {
        $hoy = new DateTime();
        //Cargo todos los cursos con alumnos y vigentes
        $cursos = Course::where("cantidadalumnos",">",0)
        ->where("cantidadcuotas",">","cuotaactual")
        ->where("ultimaclase", "<", $hoy->format("Y-m-d H:i"))->get();
        foreach ($cursos as $item) {
            $item->ultimaclase = $item->days()->where("cuota", "=", $item->cuotaactual + 1)
            ->orderBy("fecha","desc")
            ->value("fecha");
            $item->cantidadclases = $item->days()->where("cuota", "=", $item->cuotaactual + 1)->count();
            $row = $item->days()->where("cuota","=",$item->cuotaactual + 1)->first();
            $item->fechaactual = $row->fecha;
            $item->cuotaactual = $row->cuota;
            $item->save();
        }

    }

    //Actualizo el estado de las clases
    public static function updateMeetingState()
    {
        $hoy = new DateTime();
        DB::table('meetings')
            ->where('fecha',">", $hoy->format("Y-m-d H:i"))
            ->update(['estado' => "realizada"]);
    }
}
