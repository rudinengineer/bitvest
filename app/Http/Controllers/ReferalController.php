<?php

namespace App\Http\Controllers;

use App\Models\Referal;
use Illuminate\Http\Request;

class ReferalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('referal.index', [
            'title' => env('APP_NAME') . ' - Referal',
            'histories' => Referal::where('code', auth()->user()->referal_code)->get()
        ]);
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
    public function show(Referal $referal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Referal $referal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Referal $referal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Referal $referal)
    {
        //
    }
}
