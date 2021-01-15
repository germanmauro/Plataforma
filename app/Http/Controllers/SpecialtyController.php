<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        if(!session()->has('Perfil')|| session("Perfil")!="admin") {
            return redirect("");
        }
        $especialidades = Specialty::where('baja', 'false')->get();
        return view("especialidad.index", compact("especialidades"));
    }

    public function create()
    {
        $categorias = Category::where('baja', 'false')->get();

        return view("especialidad.create", compact("categorias"));
    }

    public function store(Request $request)
    {
        $especialidad = new Specialty();
        $especialidad->nombre = $request->nombre;
        $especialidad->categoria = $request->categoria;
        $especialidad->save();

        return redirect("/Especialidad");
    }

    public function edit(Specialty $especialidad)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $categorias = Category::where('baja', 'false')->get();
        return view('especialidad.update', compact("especialidad","categorias"));
    }

    public function update(Specialty $especialidad, Request $request)
    {
        $especialidad->nombre = $request->nombre;
        $especialidad->categoria = $request->categoria;
        $especialidad->save();

        return redirect("/Especialidad");
    }

    public function delete(Specialty $especialidad)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        return view('especialidad.delete', compact("especialidad"));
    }

    public function destroy(Specialty $especialidad)
    {
        $especialidad->baja = "true";
        $especialidad->save();

        return redirect("/Especialidad");
    }
}