<?php

namespace Junisan\ListmonkApi\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Junisan\ListmonkApi\Exceptions\ApiClientException;
use Junisan\ListmonkApi\Exceptions\ApiException;
use Junisan\ListmonkApi\Exceptions\ApiServerException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Client\ClientInterface;

class ListmonkApi
{
    private ClientInterface $client;
    private string $url;
    private string $username;
    private string $password;

    public function __construct(string $url, ?string $username = null, ?string $password = null, ClientInterface $client = null)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->client = $client ?? new Client();
    }

    public function get(string $path)
    {
        return $this->request('get', $path, []);
    }

    public function post(string $path, array $data)
    {
        $guzzleData = [
            'json' => $data
        ];

        return $this->request('post', $path, $guzzleData);
    }

    public function put(string $path, array $data)
    {
        $guzzleData = [
            'json' => $data
        ];

        return $this->request('put', $path, $guzzleData);
    }

    /**
     * @throws ApiClientException
     * @throws ApiException
     * @throws GuzzleException
     * @throws ApiServerException
     */
    protected function request(string $method, string $path, array $data): array
    {
        $url = $this->url . $path;
        if (!$data) {
            $data = [];
        }

        if ($this->username) {
            $data['auth'] = [$this->username, $this->password];
        }

        try {
            $response = $this->client->request($method, $url, $data);

            //Preview feature does not response with default schema. Returns response without processing it
            if($this->isCampaignPreviewPath($path)) {
                return ['preview' => $response->getBody()->getContents() ];
            }

            $json = json_decode($response->getBody()->getContents(), true);
            if (JSON_ERROR_NONE === json_last_error() && array_key_exists('data', $json)) {
                return $json['data'];
            } else {
                throw new ApiException('Unknown API response format');
            }
        } catch (ClientException $e) {
            //Client send invalid data or not found
            $message = $this->error2message($e);
            throw new ApiClientException($message);
        } catch (ServerException $e) {
            //Server is broken
            $message = $this->error2message($e);
            throw new ApiServerException($message);
        } catch (TransferException $e) {
            //Error in network
            throw new ApiException($e->getMessage());
        } catch (\Exception $e) {
            //WTF ??
            throw new ApiException($e->getMessage());
        }
    }

    protected function isCampaignPreviewPath(string $path)
    {
        $pattern = '@^/campaigns/\d+/preview$@';
        return preg_match($pattern, $path);
    }

    protected function error2message(RequestException $e)
    {
        if (!$e->hasResponse()) {
            return 'Invalid response or no response was given from server';
        }

        $response = $e->getResponse()->getBody()->getContents();
        $json = json_decode($response, true);

        return (JSON_ERROR_NONE === json_last_error() && array_key_exists('message', $json))
            ? $json['message'] : 'Unknown error from API';
    }
}