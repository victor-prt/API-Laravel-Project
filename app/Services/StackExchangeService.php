<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class StackExchangeService
{
    protected $apiUrl = 'https://api.stackexchange.com/2.3/questions';

    public function fetchQuestions($tagged, $fromDate = null, $toDate = null)
    {
        try {
            $params = [
                'site' => 'stackoverflow',
                'tagged' => $tagged,
                'sort' => 'creation',
                'order' => 'desc'
            ];

            if ($fromDate) {
                $params['fromdate'] = $fromDate;
            }

            if ($toDate) {
                $params['todate'] = $toDate;
            }

            // Realiza la solicitud HTTP
            $response = Http::get($this->apiUrl, $params);

            if ($response->successful()) {
                return $response->json(); // Retorna solo los datos en formato array
            }

            // En caso de un error en la respuesta, retorna null
            return null;

        } catch (Exception $e) {
            // En caso de excepción, también retorna null
            return null;
        }
    }
}
