<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados'] = Empleado::paginate(3);
        
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar campos vacios
        $campos=[
            'Nombres'=>'required|string|max:100',
            'Apellidos'=>'required|string|max:100',
            'Area'=>'required|string|max:100',
            'Correo'=>'required|string|max:100',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);

        // 
        $datosEmpleado = request()->except('_token');
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Empleado::insert($datosEmpleado);
        return redirect('empleado')->with('mensaje','Empleado agregado con exito');
        // return response()->json($datosEmpleado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        
        // validar campos vacios
        $campos=[
            'Nombres'=>'required|string|max:100',
            'Apellidos'=>'required|string|max:100',
            'Area'=>'required|string|max:100',
            'Correo'=>'required|string|max:100',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

        if ($request->hasFile('Foto')) {
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto es requerida'];
        }

        $this->validate($request, $campos, $mensaje);

        // 
        
        //recepciono los datos a excecion de token y method
        $datosEmpleado = request()->except('_token','_method');
        
        if($request->hasFile('Foto')){
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }

        // actualizo los datos cuando el id = al id de mi basedeDatos
        Empleado::where('id','=',$id)->update($datosEmpleado);
        // recepciono el id nuevamnete
        $empleado=Empleado::findOrFail($id);
        // retorno a la vista edit de
        // return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje', 'Registro Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado=Empleado::findOrFail($id);

        if (Storage::delete('public/'.$empleado->Foto)) {
            Empleado::destroy($id);
        }

        
        return redirect('empleado')->with('mensaje', 'Registro Eliminado');
    }
}
