<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Election;
use App\Services\DeviceFingerprint;
use Symfony\Component\HttpFoundation\Response;

class VerifyElectionDevice
{
    public function handle(Request $request, Closure $next): Response
    {
        $election = $request->route('election');
        
        if ($election instanceof Election) {
            if (!DeviceFingerprint::verify($election->device_fingerprint)) {
                abort(403, 'This election can only be accessed from the device that created it.');
            }
        }
        
        return $next($request);
    }
}
