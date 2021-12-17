<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransUserAuthLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'auth_action',
        'auth_status',
        'user_id',
        'ip_address',
        'user_agent',
        'device',
        'platform',
        'browser',
    ];

    public static function createLog($authAction, $authStatus, $request, $agent)
    {
        try {
            TransUserAuthLog::create([
                'auth_action' => $authAction,
                'auth_status' => $authStatus,
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser()
            ]);
            return true;
        } catch (Exception $e) {
        }
    }
}
