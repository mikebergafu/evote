<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SmsService
{
    public function send(string $phone, string $message, string $sender = null): bool
    {
        $sender = $sender ?? config('services.sms.sender_id', 'BITLOGIC');
        
        try {
            $url = config('services.sms.base_url').'/v5/sms/send';

            $payload = [
                'text' => $message,
                'type' => 0,
                'sender' => $sender,
                'destinations' => [$phone],
            ];

            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'key '.config('services.sms.api_key'),
            ];

            Log::info("Sending SMS to {$phone}", [
                'url' => $url,
                'payload' => $payload,
                'headers' => array_merge($headers, ['Authorization' => 'key ***']),
            ]);

            $response = $this->curlPostNoSSL($url, $payload, $headers);

            Log::info("SMS API Response for {$phone}", ['response' => $response]);

            if (is_array($response)) {
                if (isset($response['handshake']['label']) && $response['handshake']['label'] === 'HSHK_OK') {
                    if (isset($response['data']['destinations']) && is_array($response['data']['destinations'])) {
                        foreach ($response['data']['destinations'] as $destination) {
                            if (isset($destination['status']['id']) && $destination['status']['id'] === 2105) {
                                Log::info("SMS sent successfully to {$phone}");
                                return true;
                            }
                        }
                    }
                }

                if (isset($response['status']) && $response['status'] === 'success') {
                    Log::info("SMS sent successfully to {$phone}");
                    return true;
                }
            }

            Log::error("SMS failed to {$phone}: ".json_encode($response));
            return false;

        } catch (\Exception $e) {
            Log::error('SMS service error: '.$e->getMessage());
            return false;
        }
    }

    private function curlPostNoSSL($url, $payload, $headers = null)
    {
        $curl = curl_init();

        $curlHeaders = [];
        if ($headers) {
            foreach ($headers as $key => $value) {
                $curlHeaders[] = $key.':'.$value;
            }
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $curlHeaders,
            CURLOPT_FAILONERROR => false,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            throw new \Exception("cURL Error: {$error}");
        }

        return json_decode($response, true);
    }
}
