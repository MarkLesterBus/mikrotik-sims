<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Router;
use Illuminate\Support\Str;

class RouterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Router::all();
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
    public function store(Request $request)
    {
        $router = Router::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'host' => $request->host,
            'user' => $request->user,
            'pass' => $request->pass,
            'port' => $request->port,
        ]);

        return $router->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Router $router)
    {
        return $router;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Router $router)
    {
        $router->name = $request->name;
        $router->host = $request->host;
        $router->user = $request->user;
        $router->pass = $request->pass;
        $router->port = $request->port;
        $router->save();
        return $router;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Router $router)
    {
        $router->delete();
        return $router;
    }
}
