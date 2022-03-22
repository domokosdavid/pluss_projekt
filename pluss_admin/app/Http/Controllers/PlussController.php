<?php

namespace App\Http\Controllers;

use App\Models\Pluss;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Plus;

class PlussController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plussok=Pluss::all();
        return response()->json($plussok);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Pluss $request)
    {
        $pluss=new Pluss();
        $pluss->fill($request->all());
        $pluss->save();
        return response()->json($pluss, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pluss=Pluss::find($id);
        return response()->json($pluss);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pluss $pluss)
    {
        //
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
        $pluss=Pluss::find($id);
        $pluss->fill($request->all());
        $pluss->save();
        return response()->json($pluss, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pluss::destroy($id);
        return response()->noContent();
    }
}
