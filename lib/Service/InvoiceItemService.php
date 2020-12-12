<?php

// File generated from our OpenAPI spec

namespace Epayco\Service;

class InvoiceItemService extends \Epayco\Service\AbstractService
{
    /**
     * Returns a list of your invoice items. Invoice items are returned sorted by
     * creation date, with the most recently created invoice items appearing first.
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
        return $this->requestCollection('get', '/v1/invoiceitems', $params, $opts);
    }

    /**
     * Creates an item to be added to a draft invoice (up to 250 items per invoice). If
     * no invoice is specified, the item will be on the next invoice created for the
     * customer specified.
     *
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\InvoiceItem
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/invoiceitems', $params, $opts);
    }

    /**
     * Deletes an invoice item, removing it from an invoice. Deleting invoice items is
     * only possible when they’re not attached to invoices, or if it’s attached to a
     * draft invoice.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\InvoiceItem
     */
    public function delete($id, $params = null, $opts = null)
    {
        return $this->request('delete', $this->buildPath('/v1/invoiceitems/%s', $id), $params, $opts);
    }

    /**
     * Retrieves the invoice item with the given ID.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\InvoiceItem
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/invoiceitems/%s', $id), $params, $opts);
    }

    /**
     * Updates the amount or description of an invoice item on an upcoming invoice.
     * Updating an invoice item is only possible before the invoice it’s attached to is
     * closed.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\Epayco\Util\RequestOptions $opts
     *
     * @throws \Epayco\Exception\ApiErrorException if the request fails
     *
     * @return \Epayco\InvoiceItem
     */
    public function update($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/invoiceitems/%s', $id), $params, $opts);
    }
}
