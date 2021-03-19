<?php

namespace App\Http\View\Composers;

use App\Models\Buy;
use App\Models\Notification;
use DateInterval;
use DateTime;
use Illuminate\View\View;

class ProfileComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (session()->has('Perfil')) {
            $notifications = Notification::where(["user_id" => session("Id"), "estado" => "creada"])
            ->orderBy("created_at","desc")->get();
            $primeraClase = count(Buy::where(["user_id" => session("Id"), "estado" => "Pagado"])->get());
            $hoy = new DateTime();
            $hoy->add(new DateInterval("P7D"));
            $pendientes = Buy::where("user_id",session("Id"))->where("Estado", "Pendiente")
            ->where('fechavencimiento', "<", $hoy->format('Y-m-d H:i'))->get();
            if($primeraClase) {
                $primeraClase = 0;
            } else {
                $primeraClase = 1;
            }
            $view->with(compact("notifications","primeraClase","pendientes"));
        }
    }
}
