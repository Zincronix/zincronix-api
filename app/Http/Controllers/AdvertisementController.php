<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Advertisement::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')){
            $validado=$request->validate([
                'title'=>'required',
                'image'=>'nullable|mimes:jpeg,png,jpg,binary',
                'document'=>'nullable|mimes:pdf,doc,docx'
            ],[
                'title.required'=>'este campo es requerido',
                'image.mimes'=>'solo se permiten archivos de tipo: jpeg, png, jpg',
                'document.mimes'=>'solo se permiten archivos de tipo: pdf, doc, docx'
            ]);
        }

        $noticia=new Advertisement();
        $noticia->title=$request->input('title');
        $noticia->description=$request->input('description');
        $noticia->author="nuevo autor";
        if($request->hasFile('image')){
        $nombre=$request->file('image');
        $nombreOriginal=$nombre->getClientOriginalNAme();
        $nombreArchivo = str_replace(' ', '_', $nombreOriginal);
        $direccionIMG = $nombre->storeAs('Advertisement', $nombreArchivo, 'public');
        //$direccionIMG = $request->file('image')->store('Advertisement', 'public');
        $origen = "http://127.0.0.1:8000/storage/";
        $cadenaTotal = $origen . $direccionIMG;
        $noticia->image = $cadenaTotal;
        }else{
            $noticia->image="esta noticia no tiene una imagen";
        }

        if($request->hasFile('document')){
            $nombre=$request->file('document');
            $nombreOriginal=$nombre->getClientOriginalNAme();
            $nombreArchivo = str_replace(' ', '_', $nombreOriginal);
            $direccionIMG = $nombre->storeAs('Advertisement', $nombreArchivo, 'public');
            $origen = "http://127.0.0.1:8000/storage/";
            $cadenaTotal = $origen . $direccionIMG;
            $noticia->document = $cadenaTotal;
            }else{
                $noticia->document="esta noticia no tiene un archivo";
            }
        $noticia->save();

        return response()->json([
            'status'=>true,
            'message'=>'noticia creada satisfactoriamente'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia=Advertisement::find($id)->get(); 
        return $noticia;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
