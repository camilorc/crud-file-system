<?php

namespace App\Http\Controllers;

use App\Document;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{

    public function index()
    {
        //Método para la lista los documentos
        return view("documents.documents_index", ["documents"=>Document::all()]);
    }


    public function create()
    {

        //Método para la vista del formulario de creación
        return view("documents.documents_create",['users'=>User::All()]);
    }


    public function store(Request $request)
    {
        
        //Hacemos algunas validaciones del archivo , su tipo y su peso
        $request->validate([
            'file' => 'required|mimes:csv,pdf|max:2048'
        ]);

        $fileModel = new Document;

        //Verificamos que exista un archivo adjunto
        if($request->file()) {

            //Creams un file Name único 
            $fileName = time().'_'.$request->file->getClientOriginalName();
            //Guardamos en storage el archivo
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            //Definimos propiedades del objeto documento
            $fileModel->name = $request->name;
            $fileModel->url = $filePath;
            $fileModel->user_id = $request->user;
            $fileModel->save();

            return redirect()->route("documents.index");
        }


    }

    public function edit(Document $document)
    {
        
        //Método para vista de edición
        return view("documents.documents_edit",['document' => $document,'users'=>User::All()]);
    }


    public function update(Request $request, Document $document)
    {
        //Acualizamos el  usuario dueño
        $document->user_id = $request->user;
        $document->save();
        return redirect()->route("documents.index");
    }


    public function destroy(Document $document)
    {
        //Obtenemos el path del archivo
        $file_path = storage_path('app/public/'.$document->url);
        //Eliminamos el archivo
        unlink($file_path);
        //Eliminamos registro en la Base de Datos
        $document->delete();
        return redirect()->route("documents.index");

    }
}
