<?php

namespace Craft\Inertia\Ssr;

use Bitrix\Main\DI\ServiceLocator;
use Bitrix\Main\Diag\Debug;
use Craft\Inertia\Inertia;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use HttpResponseException;

class HttpGateway implements Gateway
{
    /**
     * Dispatch the Inertia page to the Server Side Rendering engine.
     */
    public function dispatch(array $page): ?Response
    {
        if (!$this->shouldDispatch()) {
            return null;
        }

        $client = new Client([
            'connect_timeout' => 10,
            'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
            'http_errors' => false,
            'timeout' => 30,
        ]);

        try {
            $responseRaw = $client->post($this->getUrl('/render'), [
                RequestOptions::HEADERS => ['Content-Type' => 'application/json'],
                RequestOptions::JSON => $page,
            ]);

            if (($code = $responseRaw->getStatusCode()) < 200 || $code >= 300) {
                throw new HttpResponseException('Bad code: ' . $code);
            }

            $response = json_decode($responseRaw->getBody());
        } catch (Exception) {
            return null;
        }

        if (is_null($response)) {
            return null;
        }

        return new Response(
            implode("\n", $response['head']),
            $response['body']
        );
    }

    /**
     * Determine if the page should be dispatched to the SSR engine.
     */
    protected function shouldDispatch(): bool
    {
//		Debug::dump(\inertia()->config('ssr.enabled'));
//		Debug::dump(!is_null(\inertia()->getBundlePath()));
//		Debug::dump(\inertia()->config('ssr.enabled') && !is_null(\inertia()->getBundlePath()));
//		Debug::dump(\inertia()->config('enabled'));
//		Debug::dump(\inertia()->config('ssr.enabled'));
//		Debug::dump(\inertia()->config('config.enabled'));
////		Debug::dump(\inertia()->getConfig());
//		exit();


        return \inertia()->config('ssr.enabled') && !is_null(\inertia()->getBundlePath());
    }

    /**
     * Get the SSR URL from the configuration, ensuring it ends with '/{$path}'.
     */
    public function getUrl(string $path): string
    {
        return HttpGateway . phpstr_replace(
				$path,
				'',
				rtrim(
					\inertia()->config('inertia.ssr.url', 'http://127.0.0.1:13714'),
					'/'
				)
			) . $path;
    }
}
