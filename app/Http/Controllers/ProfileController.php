<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Query;
class ProfileController extends Controller
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

        $query = new Query('/ip/hotspot/user/profile/print');

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

        if ($request->user_lck){
            $user_lck = '; [:local mac $"mac-address"; /ip hotspot user set mac-address=$mac [find where name=$user]]';
        }else{
            $user_lck ='';
        }
        
        if ($request->server_lck){
            $server_lck = '; [:local mac $"mac-address"; :local srv [/ip hotspot host get [find where mac-address="$mac"] server]; /ip hotspot user set server=$srv [find where name=$user]]';
        }else{
            $server_lck ='';
        }

        if($request->mode == "ntf" || $request->mode == "ntfc" ){
            $mode = "N";
        }elseif($request->mode == "rem" || $request->mode == "remc" ){
            $mode = "X";
        }

        $record = '; :local mac $"mac-address"; :local time [/system clock get time ]; /system script add name="$date-|-$time-|-$user-|-$address-|-$mac-|-'. $request->validity . '-|-'.$request->name.'-|-$comment" owner="$month$year" source=$date comment=mikhmon';
        $onlogin = ':local mode "'. $mode .'"; {:local date [ /system clock get date ];:local year [ :pick $date 7 11 ];:local month [ :pick $date 0 3 ];:local comment [ /ip hotspot user get [/ip hotspot user find where name="$user"] comment]; :local ucode [:pic $comment 0 2]; :if ($ucode = "vc" or $ucode = "up" or $comment = "") do={ /sys sch add name="$user" disable=no start-date=$date interval="' . $request->validity . '"; :delay 2s; :local exp [ /sys sch get [ /sys sch find where name="$user" ] next-run]; :local getxp [len $exp]; :if ($getxp = 15) do={ :local d [:pic $exp 0 6]; :local t [:pic $exp 7 16]; :local s ("/"); :local exp ("$d$s$year $t"); /ip hotspot user set comment="$exp $mode" [find where name="$user"];}; :if ($getxp = 8) do={ /ip hotspot user set comment="$date $exp $mode" [find where name="$user"];}; :if ($getxp > 15) do={ /ip hotspot user set comment="$exp $mode" [find where name="$user"];}; /sys sch remove [find where name="$user"]';
        $onlogin = $onlogin . $record . $user_lck . $server_lck ."}}";

        
        $query = new Query('/ip/hotspot/user/profile/add');
        $name = (preg_replace('/\s+/', '-',$request->name));
        $query->equal("name", $name);
        $query->equal("shared-users" , $request->shared_user);
        $query->equal("on-login" , $onlogin);


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
        //
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
