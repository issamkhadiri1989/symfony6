<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyConverter
{
    public function __construct(private HttpClientInterface $client, private string $api)
    {
    }

    /**
     * Perform the currency conversion.
     *
     * @param string $from  from which currency the conversion will be performed
     * @param string $to    to which currency  the conversion will be performed
     * @param float $amount the amount to be converted
     *
     * @return float|null
     */
    public function convert(string $from, string $to, float $amount): float|null
    {
        $query = \sprintf('%s_%s', $from, $to);
        try {
            $response = $this->doConversion($query);


            return $response[$query] * $amount;
        } catch (TransportExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface) {
            // Maybe log the error or display it in the terminal
            return null;
        }
    }

    /**
     * Call Api and return result.
     *
     * @param string $query the query which contains the from and to currencies
     *
     * @return mixed an array which contains data from API or something else if json_decode didn't work
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    private function doConversion(string $query): mixed
    {
        $data = $this->client->request(url: $this->api, method: 'GET', options: ['query' => ['q' => $query]]);

        return \json_decode($data->getContent(), true);
    }
}