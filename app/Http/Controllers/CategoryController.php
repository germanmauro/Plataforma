<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $categorias = Category::where('baja','false')->get();
      
        return view("categoria.index",compact("categorias"));
    }

    //Listar para cursos
    public function showcategoriesadultos()
    {
        $categorias = Category::where('baja','false')
        ->where("destinatario","Adultos")
        ->orderBy('nombre')->get();
      
        return view("cursos.categorias",compact("categorias"));
    }

    public function showcategoriesniños()
    {
        $categorias = Category::where('baja','false')
        ->where("destinatario", "Niños")
        ->orderBy('nombre')->get();
      
        return view("cursos.categorias",compact("categorias"));
    }

    public function store(Request $request)
    {
        $categoria = new Category();
        $categoria->nombre = $request->nombre;
        $categoria->texto = $request->texto;
        $categoria->destinatario = $request->destinatario;
        $nombre = "";
        if ($request->hasFile('imagen')) {
            $nombre = $request->file('imagen')->store("public/categorias");
            $categoria->imagen = str_replace("public/categorias/", "", $nombre);
        }
        $categoria->save();

        return redirect("/Categoria")->with("success", "Registro generado correctamente");
    }

    public function edit(Category $categoria)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        return view('categoria.update',compact("categoria"));
    }

    public function update(Category $categoria, Request $request)
    {
        $categoria->nombre = $request->nombre;
        $categoria->texto = $request->texto;
        $categoria->destinatario = $request->destinatario;
        $nombre = "";
        if ($request->hasFile('imagen')) {
            $nombre = $request->file('imagen')->store("public/categorias");
            $categoria->imagen = str_replace("public/categorias/", "", $nombre);
        }
        $categoria->save();

        return redirect("/Categoria")->with("success", "Registro actualizado correctamente");;
    }

    public function delete(Category $categoria)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        return view('categoria.delete', compact("categoria"));
    }

    public function destroy(Category $categoria)
    {
        $categoria->baja = "true";
        $categoria->save();

        return redirect("/Categoria")->with("success", "Registro eliminado correctamente");
    }
    
}
