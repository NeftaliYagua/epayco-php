<?php

// File generated from our OpenAPI spec

namespace Epayco\Service\Reporting;

class ReportTypeService extends \Epayco\Service\AbstractService
{
    /**
     * Returns a full list of Report Types. (Requires a <a
     * href="https://stripe.com/docs/keys#test-live-modes">live-mode API key</a>.).
     *
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Collection
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/reporting/report_types', $params, $opts);
    }

    /**
     * Retrieves the details of a Report Type. (Requires a <a
     * href="https://stripe.com/docs/keys#test-live-modes">live-mode API key</a>.).
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\Reporting\ReportType
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/reporting/report_types/%s', $id), $params, $opts);
    }
}
