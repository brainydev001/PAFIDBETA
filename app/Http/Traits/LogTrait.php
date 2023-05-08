<?php
namespace App\Http\Traits;
use App\Models\Log;
use Carbon\Carbon;

trait LogTrait {
    /**
     * Reusable public functions to accept variables from other functions and create logs 
     */
    public function log($origin, $type, $cluster_name, $user_id, $details)
    {
        // log details
        $dateTime = Carbon::now();
        // additional log information
        $deviceInfo = $_SERVER['HTTP_USER_AGENT'];
        $location = $_SERVER['REMOTE_ADDR'];
        $accessServerPort = $_SERVER['REMOTE_PORT'];
        // declare device and location info
        $data = [
            'origin' => $origin,
            'type' => $type,
            'cluster_name' => $cluster_name,
            'user_id' => $user_id,
            'details' => $details,
            'unique_identifier_device' => $deviceInfo,
            'unique_identifier_location' => $location,
            'unique_identifier_location' => $location,
            'unique_identifier_ip' => $accessServerPort
        ];

        $this->create($data);
    }

    
    /**
     * Reusable private functions to create logs and communicate them to relevant users
     */
    private function create($data)
    {
        Log::create($data);
    }
}