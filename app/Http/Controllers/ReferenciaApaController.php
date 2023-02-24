<?php

namespace App\Http\Controllers;

use App\ReferenciaApa;
use App\Syllabus;
use Illuminate\Http\Request;

class ReferenciaApaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($syllabus_id)
    {
        try {
            $syllabus = Syllabus::find($syllabus_id);
            return view('UsersViews.docente.referencias_bibliograficas.index', compact('syllabus'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
    public function store(Request $request, $syllabus_id)
    {
        $syllabus = Syllabus::find($syllabus_id);

        if ($syllabus != null) {
                $referencia_bibliografica = new ReferenciaApa;
                $referencia_bibliografica->syllabus_id = $syllabus->id;
                $referencia_bibliografica->referencias = $request->input('referencias');
                $referencia_bibliografica->save();
                return redirect()->route('referenciaApa', $syllabus->id);
        }
        return redirect()->route('syllabus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReferenciaApa  $referenciaApa
     * @return \Illuminate\Http\Response
     */
    public function show(ReferenciaApa $referenciaApa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReferenciaApa  $referenciaApa
     * @return \Illuminate\Http\Response
     */
    public function edit($referencia_id)
    {
        $referencia = ReferenciaApa::find($referencia_id);
        $syllabus = Syllabus::find($referencia->syllabus_id);
        return view('UsersViews.docente.referencias_bibliograficas.edit', compact('referencia','syllabus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReferenciaApa  $referenciaApa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $referencia_id)
    {
        $referencia = ReferenciaApa::find($referencia_id);
        if ($referencia != null) {
            $referencia->referencias = $request->input('referencias');
            $referencia->save();
        }
        return redirect()->route('referenciaApa', $referencia->syllabus_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReferenciaApa  $referenciaApa
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReferenciaApa $referenciaApa)
    {
        //
    }
}
