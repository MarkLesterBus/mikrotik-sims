<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Query;

class BridgeController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $host = env('MIKROTIK_HOST'); 
        $user = env('MIKROTIK_USER'); 
        $pass = env('MIKROTIK_PASS'); 
        $port = (int)env('MIKROTIK_PORT'); 

        $client = new Client(['host' => $host,'user' => $user,'pass' => $pass,'port' => $port]);

        $bridge = $client->query('/files')->read();
        return $bridge;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Router $router)
    {
        $host = env('MIKROTIK_HOST'); 
        $user = env('MIKROTIK_USER'); 
        $pass = env('MIKROTIK_PASS'); 
        $port = (int)env('MIKROTIK_PORT'); 

        $client = new Client(['host' => $host,'user' => $user,'pass' => $pass,'port' => $port]);
        $query = (new Query('/interface/bridge/add'))->equal('name', $request->name);
        $rs = $client->query($query)->read();
        return $rs;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $host = env('MIKROTIK_HOST'); 
        $user = env('MIKROTIK_USER'); 
        $pass = env('MIKROTIK_PASS'); 
        $port = (int)env('MIKROTIK_PORT'); 

        $client = new Client(['host' => $host,'user' => $user,'pass' => $pass,'port' => $port]);

        $query = new Query('/interface/bridge/print');
        $query->where('.id', $id);
        $rs = $client->query($query)->read();
        return $rs;
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
    public function update(Request $request, $id)
    {
        //
        $host = env('MIKROTIK_HOST'); 
        $user = env('MIKROTIK_USER'); 
        $pass = env('MIKROTIK_PASS'); 
        $port = (int)env('MIKROTIK_PORT'); 

        $client = new Client(['host' => $host,'user' => $user,'pass' => $pass,'port' => $port]);

        $query = new Query('/interface/bridge/set');
        $query->equal('.id', $id);
        $query->equal('name', $request->name);


        $rs = $client->query($query)->read();
        return $rs;
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
        $host = env('MIKROTIK_HOST'); 
        $user = env('MIKROTIK_USER'); 
        $pass = env('MIKROTIK_PASS'); 
        $port = (int)env('MIKROTIK_PORT'); 

        $client = new Client(['host' => $host,'user' => $user,'pass' => $pass,'port' => $port]);

        $query = new Query('/interface/bridge/remove');
        $query->equal('.id', $id);


        $rs = $client->query($query)->read();
        return $rs;
    }
}
