<?php

namespace Magmodules\DistanceBasedShippingCost\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Magmodules\DistanceBasedShippingCost\Exception\GoogleMapsApiResponseException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Response;


class GoogleMapsApiService
{
    /** @var string */
    public const API_URL = 'https://maps.googleapis.com/maps/api/distancematrix/json';

    /**
     * @var array<string, mixed>
     */
    private array $queryParams = [
        'origins' => '',
        'destinations' => '',
        'mode' => 'driving',
        'sensor' => false,
        'units' => 'mi',
        'key' => ''
    ];

    private Client $client;

    private AdapterInterface $cache;

    public function __construct(Client $client, AdapterInterface $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    /**
     * @throws \Magmodules\DistanceBasedShippingCost\Exception\GoogleMapsApiResponseException
     */
    public function getDistanceInMeters(string $apiKey, string $origin, string $destination): ?float
    {
        try {
            $cacheKey = md5($apiKey.$origin.$destination);
            $cacheItem = $this->cache->getItem($cacheKey);

            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }

            $this->queryParams['key'] = $apiKey;
            $this->queryParams['origins'] = $origin;
            $this->queryParams['destinations'] = $destination;

            $response = $this->client->get(
                self::API_URL,
                ['query' => $this->queryParams]
            );

            if ($response->getStatusCode() === Response::HTTP_OK) {
                $content = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
                if ($content['status'] !== "OK") {
                    throw new GoogleMapsApiResponseException($content['error_message'] ?? $content['status'], 500);
                }

                $cacheItem->set($content['rows'][0]['elements'][0]['distance']['value']);
                $this->cache->save($cacheItem);

                return $content['rows'][0]['elements'][0]['distance']['value'];

            }

            throw new GoogleMapsApiResponseException("Error Communicating with Google Maps API", 500);

        } catch (\Exception|GuzzleException|InvalidArgumentException $e) {
            throw new GoogleMapsApiResponseException($e->getMessage(), 500);
        }
    }
}
