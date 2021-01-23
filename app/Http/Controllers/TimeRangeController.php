<?php

namespace App\Http\Controllers;

use App\Models\TimeRange;
use Illuminate\Http\Request;

class TimeRangeController extends Controller
{
    public function index()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $rangos = TimeRange::where('baja', 'false')->get();

        return view("rangohorario.index", compact("rangos"));
    }

    public function store(Request $request)
    {
        $rango = new TimeRange();
        $rango->nombre = $request->nombre;
        $rango->rango = $request->rango;
        $rango->save();

        return redirect("/RangoHorario")->with("success", "Registro generado correctamente");
    }

    public function edit(TimeRange $rangohorario)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        return view('rangohorario.update', compact("rangohorario"));
    }

    public function update(TimeRange $rangohorario, Request $request)
    {
        $rangohorario->nombre = $request->nombre;
        $rangohorario->rango = $request->rango;
        $rangohorario->save();

        return redirect("/RangoHorario")->with("success", "Registro actualizado correctamente");
    }

    public function delete(TimeRange $rangohorario)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        return view('rangohorario.delete', compact("rangohorario"));
    }

    public function destroy(TimeRange $rangohorario)
    {
        $rangohorario->baja = "true";
        $rangohorario->save();

        return redirect("/RangoHorario")->with("success", "Registro eliminado correctamente");
    }
}
