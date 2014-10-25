<?php

namespace Acme\DataGridBundle\Services\Request;


class DataGridPostRequest extends BaseDataGridRequest {

    function getRequestType()
    {
        return "POST";
    }

    protected function initRequestData()
    {
        // TODO: Implement initRequestData() method.
    }
}