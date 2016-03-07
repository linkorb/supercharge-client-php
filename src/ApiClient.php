<?php

namespace Supercharge\Client;

use GuzzleHttp\Client as GuzzleClient;

class ApiClient
{
    private $username;
    private $password;
    private $url;
    private $httpClient;
    
    public function __construct($username, $password, $url)
    {
        if (!$username || !$password || !$url)
            throw new \Exception('Please provide api url and username/password credentials');
        $this->username = $username;
        $this->password = $password;
        $this->url = $url;
        $this->httpClient = new GuzzleClient();
    }

    public function request($method, $path, $data = [])
    {
        try {
            $url = $this->url . '/' . $path;
            $request = [
                'auth' => [$this->username, $this->password],
                'headers' => ['content-type' => 'application/json'],
            ];
            if ($method != 'get')
            {
                $request['body'] = json_encode($data, JSON_PRETTY_PRINT);
            }
            $res = $this->httpClient->$method($url, $request);
            return $this->interpretResponse($res->getBody(), $res->getStatusCode());
        }
        catch (\Exception $e)
        {
            $res = $e->getResponse();
            $this->handleApiError($res->getBody(), $res->getStatusCode(), json_decode($res->getBody(), true));
        }
    }

    public function handleApiError($rbody, $rcode, $resp)
    {
        if (!is_array($resp) || !isset($resp['error'])) {
            $msg = "Invalid response object from API: $rbody "
                . "(HTTP response code was $rcode)";
            throw new \Exception($msg, $rcode);
        }
        $error = $resp['error'];
        $msg = isset($error['message']) ? $error['message'] : null;

        throw new \Exception($msg, $rcode);
    }

    private function interpretResponse($rbody, $rcode)
    {
        try {
            $resp = json_decode($rbody, true);
        } catch (\Exception $e) {
            $msg = "Invalid response body from API: $rbody "
                . "(HTTP response code was $rcode)";
            throw new \Exception($msg, $rcode);
        }
        if ($rcode < 200 || $rcode >= 300) {
            $this->handleApiError($rbody, $rcode, $resp);
        }
        return $resp;
    }
}
