<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa\EmpresaArea;
use Illuminate\Http\Request;

class EmpresaAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(session());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmpresaArea $empresaArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmpresaArea $empresaArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmpresaArea $empresaArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmpresaArea $empresaArea)
    {
        //
    }
}
