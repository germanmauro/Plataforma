<?php

namespace App\Http\View\Composers;

use App\Models\Notification;
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
            $not = Notification::where(["user_id" => session("Id"), "estado" => "creada"])->get();
            $view->with(['notifications' => $not]);
        }
    }
}
