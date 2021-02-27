<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show(Notification $notification)
    {
        if (!session()->has('Perfil') || $notification->user_id != session("Id")) {
            return redirect("");
        }
        $notification->estado = "leida";
        $notification->save();
        return view('notificacion.show', compact("notification"));
    }

    public function showall()
    {
        if (!session()->has('Perfil')) {
            return redirect("");
        }
        $notificaciones = Notification::where("user_id",session("Id"))
        ->where("estado","creada")
        ->Orderby("created_at","Desc")->get();
        //Actualizado las notificaciones a leídas.
        Notification::where("estado","creada")
        ->update(["estado"=>"leida"]);
        return view('notificacion.showall', compact("notificaciones"));
    }
}
