<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Query;

class HotspotProfileController extends Controller
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

        $query = new Query('/ip/hotspot/profile/print');

        $rs = $client->query($query)->read();
        return $rs;
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
        $host = env('MIKROTIK_HOST'); 
        $user = env('MIKROTIK_USER'); 
        $pass = env('MIKROTIK_PASS'); 
        $port = (int)env('MIKROTIK_PORT'); 

        $client = new Client(['host' => $host,'user' => $user,'pass' => $pass,'port' => $port]);

        $query = new Query('/ip/hotspot/profile/add');

        $query->equal("name", $request->name);
        $query->equal("hotspot-address", $request->hotspot_address);
        $query->equal("dns-name", $request->dns_name);
        $query->equal("html-directory", $request->html_directory);
        $query->equal("html-directory-override", $request->html_directory_override);
        $query->equal("rate-limit", $request->rate_limit);
        $query->equal("http-proxy", $request->http_proxy);
        $query->equal("smtp-server", $request->smtp_server);
        $query->equal("login-by", $request->login_by);
        $query->equal("http-cookie-lifetime", $request->cookie_lifetime);
        $query->equal("split-user-domain", $request->user_domain);
        $query->equal("use-radius", $request->use_radius);

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
        $query = new Query('/ip/hotspot/profile/print');
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
        $host = env('MIKROTIK_HOST'); 
        $user = env('MIKROTIK_USER'); 
        $pass = env('MIKROTIK_PASS'); 
        $port = (int)env('MIKROTIK_PORT'); 

        $client = new Client(['host' => $host,'user' => $user,'pass' => $pass,'port' => $port]);

        $query = new Query('/ip/hotspot/profile/set');
        $query->equal('.id', $id);
        $query->equal("name", $request->name);
        $query->equal("hotspot-address", $request->hotspot_address);
        $query->equal("dns-name", $request->dns_name);
        $query->equal("html-directory", $request->html_directory);
        $query->equal("html-directory-override", $request->html_directory_override);
        $query->equal("rate-limit", $request->rate_limit);
        $query->equal("http-proxy", $request->http_proxy);
        $query->equal("smtp-server", $request->smtp_server);
        $query->equal("login-by", $request->login_by);
        $query->equal("http-cookie-lifetime", $request->cookie_lifetime);
        $query->equal("split-user-domain", $request->user_domain);
        $query->equal("use-radius", $request->use_radius);

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
        $host = env('MIKROTIK_HOST'); 
        $user = env('MIKROTIK_USER'); 
        $pass = env('MIKROTIK_PASS'); 
        $port = (int)env('MIKROTIK_PORT'); 

        $client = new Client(['host' => $host,'user' => $user,'pass' => $pass,'port' => $port]);
        $query = new Query('/ip/hotspot/profile/remove');
        $query->equal('.id', $id);

        $rs = $client->query($query)->read();
        return $rs;
    }
}
