<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkStoreRequest;
use App\Http\Requests\LinkUpdateRequest;
use App\Services\LinkServices;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    public LinkServices $services;

    public function __construct(LinkServices $services)
    {
        $this->services = $services;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json($this->services->paginate());
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
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
    public function store(LinkStoreRequest $request)
    {
        try {
            $link = $this->services->store($request->all());

            return response()->json($link, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode() ?: 505);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $link = $this->services->find($id);
            return response()->json($link, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode() ?: 505);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LinkUpdateRequest $request, string $id)
    {
        try {
            $link = $this->services->update($id, $request->all());

            return response()->json($link, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode() ?: 505);
        }
    }

    public function redirect(string $slug)
    {

        $link = $this->services->metric($slug);

        return response()->redirectTo($link->long_link);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->services->destroy($id);

            return response()->json(['message' => 'Link excluido com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode() ?: 505);
        }
    }
}
