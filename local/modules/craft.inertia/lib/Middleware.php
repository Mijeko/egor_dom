<?php

namespace Craft\Inertia;

use Bitrix\Main\Engine\Response\Redirect;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\HttpResponse;
use Craft\Inertia\Support\Header;

class Middleware
{
    public function handle(HttpRequest $request, HttpResponse $response): HttpResponse
    {
        $response->addHeader('Vary', Header::INERTIA);

        if (! $request->getHeader(Header::INERTIA)) {
            return $response;
        }

        if (
            $request->getRequestMethod() === 'GET'
            && ($request->getHeader(Header::VERSION) ?? '') !== inertia()->getVersion()
        ) {
            $response = $this->redirect($request->getRequestUri());
        }

        if (
            $response->getStatus() >= 200
            && $response->getStatus() < 300
            && empty($response->getContent())
        ) {
            $response = $this->redirect($request->getHeader('HTTP_REFERER') ?? '/');
        }

        if (
            $response->getStatus() === 302
            && in_array($request->getRequestMethod(), ['PUT', 'PATCH', 'DELETE'])
        ) {
            $response->setStatus(303);
        }

        return $response;
    }

    protected function redirect(string $url, int $status = 302): HttpResponse
    {
        ($response = new Redirect($url))
            ->setStatus("$status Moved");
        return $response;
    }
}
