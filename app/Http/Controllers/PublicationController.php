<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $publicaciones = Publication::where('baja', 'false')
        ->where("user_id",session("Id"))->get();
        
        return view("publicacion.index", compact("publicaciones"));
    }

    public function create()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));

        return view("publicacion.create", compact("user"));
    }

    public function store(Request $request)
    {
        $publicacion = new Publication();
        $publicacion->user_id = session("Id");
        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->specialty_id = $request->especialidad;
        $publicacion->duracion = $request->duracion;
        $publicacion->precio = $request->precio;
        $publicacion->video = $request->video;
        $nombre = "";
        if ($request->hasFile('imagen1')) {
            $nombre = $request->file('imagen1')->store("public/publicaciones");
            $publicacion->imagen1 = str_replace("public/publicaciones/", "", $nombre);
        }
        if ($request->hasFile('imagen2')) {
            $nombre = $request->file('imagen2')->store("public/publicaciones");
            $publicacion->imagen2 = str_replace("public/publicaciones/", "", $nombre);
        }
        if ($request->hasFile('imagen3')) {
            $nombre = $request->file('imagen3')->store("public/publicaciones");
            $publicacion->imagen3 = str_replace("public/publicaciones/", "", $nombre);
        }
        $publicacion->save();

        return redirect("/Publicaciones")->with("success", "Publicación generada correctamente");
    }

    public function edit(Publication $publicacion)
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        return view('publicacion.update', compact("publicacion"));
    }

    public function update(Publication $categoria, Request $request)
    {
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return redirect("/Categoria")->with("success", "Registro actualizado correctamente");;
    }

    //Pausar, eliminar y reactivar publicacion
    public function pause(Publication $publicacion)
    {
        $publicacion->estado = "Pausada";
        $publicacion->save();
        session()->flash("success", "La publicación ".$publicacion->titulo." ha sido pausada");
    }
    
    public function reactivate(Publication $publicacion)
    {
        $publicacion->estado = "Activa";
        $publicacion->save();
        session()->flash("success","La publicación ".$publicacion->titulo." ha sido reactivada");
    }
    
    public function delete(Publication $publicacion)
    {
        $publicacion->estado = "Eliminada";
        $publicacion->baja = "true";
        $publicacion->save();
        session()->flash("success", "La publicación " . $publicacion->titulo . " ha sido eliminada");
    }
}
