<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Http;
trait IBFlexQueriesTrait
{
    /*
    Sample response:
    <FlexStatementResponse timestamp="28 August, 2012 10:37 AM EDT">
    <Status>Success</Status>
    <ReferenceCode>1234567890</ReferenceCode>
    <url>https://ndcdyn.interactivebrokers.com/AccountManagement/FlexWebService/GetStatement</url>
    </FlexStatementResponse>

    Sample error response:
    <FlexStatementResponse timestamp="28 August, 2012 10:37 AM EDT">
    <Status>Fail</Status>
    <ErrorCode>1012</ErrorCode>
    <ErrorMessage>Token has expired.</ErrorMessage>
    </FlexStatementResponse>

    URL response will be the content.
    In case of error:
        <FlexStatementResponse timestamp="28 August, 2012 10:37 AM EDT">
        <Status>Fail</Status>
        <ErrorCode>1015</ErrorCode>
        <ErrorMessage>Token is invalid.</ErrorMessage>
        </FlexStatementResponse>
    */

    public function getIBFlexQueryBaseUrl() {
        return 'https://ndcdyn.interactivebrokers.com/AccountManagement/FlexWebService/SendRequest?t=TTT&q=QQQ&v=3';
    }

    public function getIBFlexQuery($queryId, $token) {
        // request the flex query executin from TWS
        // https://www.ibkrguides.com/clientportal/performanceandstatements/flex-web-service.htm
        $url = $this->getIBFlexQueryUrl($queryId, $token);
        $response = Http::get($url);
        // parse the response xml   
        $xml = simplexml_load_string($response->body());
        if ($xml->Status == 'Fail') {
            throw new \Exception('IBFlex query run failed: ' . $xml->ErrorMessage);
        }

        $url = (string)$xml->Url . '?&t=' . $token . '&q=' . $xml->ReferenceCode . '&v=3';
        $response = Http::get($url);
        if ($response->status() != 200) {
            $xml = simplexml_load_string($response->body());
            throw new \Exception('IBFlex query generation failed: ' . $xml->ErrorCode . ' - ' . $xml->ErrorMessage);
        }
        
        return $response;
    }

    public function getIBFlexQueryUrl($queryId, $token) {
        $url = str_replace('TTT', $token, $this->getIBFlexQueryBaseUrl());
        $url = str_replace('QQQ', $queryId, $url);
        return $url;
    }
}
