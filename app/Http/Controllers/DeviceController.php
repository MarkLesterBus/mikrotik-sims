<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Router;
use RouterOS\Client;
use RouterOS\Query;

class DeviceController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //DEVICE IDENTITY
    public function index($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/system/identity/print');
        $device = $client->query($query)->read();
        return response()->json($device, 200);
    }
    //DEVICE RESOURCE
    public function resource($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/system/resource/print');
        $resource = $client->query($query)->read();
        return response()->json($resource, 200);
    }
    //DEVICE CLOCK
    public function clock($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/system/clock/print');
        $clock = $client->query($query)->read();

        return response()->json($clock, 200);
    }
    //INTERFACES
    public function interfaces($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/interface/print');
        $interface = $client->query($query)->read();

        return response()->json($interface, 200);
    }
    //TRAFFIC
    public function traffic($uuid, $interface)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = (new Query('/interface/monitor-traffic'))
            ->equal('interface', 'ether1')
            ->equal('once');
        $traffic = $client->query($query)->read();

        return response()->json($traffic, 200);
    }
    //SERVERS
    public function servers($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/hotspot/print');
        $servers = $client->query($query)->read();

        return response()->json($servers, 200);
    }
    //PROFILES
    public function server_profiles($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/hotspot/profile/print');

        $profiles = $client->query($query)->read();

        return response()->json($profiles, 200);
    }
    //POOL
    public function pool($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/pool/print');

        $pool = $client->query($query)->read();

        return response()->json($pool, 200);
    }
    //DHCP
    public function dhcp($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/dhcp-server/print');

        $dhcp = $client->query($query)->read();

        return response()->json($dhcp, 200);
    }
    //ADDRESSES
    public function addresses($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/ip/address/print');

        $addresses = $client->query($query)->read();

        return response()->json($addresses, 200);
    }
    //LOGS
    public function logs($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/log/print');

        $logs = $client->query($query)->read();

        return response()->json($logs, 200);
    }
    public function queue_simple($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/queue/simple/print');

        $queue = $client->query($query)->read();

        return response()->json($queue, 200);
    }
    public function queue_tree($uuid)
    {
        $device = Router::where('uuid', $uuid)->first();
        $client = new Client(['host' => $device->host, 'user' => $device->user, 'pass' => $device->pass, 'port' => (int)$device->port]);
        $query = new Query('/queue/tree/print');

        $queue = $client->query($query)->read();

        return response()->json($queue, 200);
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
        //
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
