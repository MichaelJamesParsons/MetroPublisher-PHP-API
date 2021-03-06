<?php

namespace MetroPublisher\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpClientInterface
 * @package MetroPublisher\Http
 */
interface HttpClientInterface
{
    /**
     * @return array
     */
    public function getOptions();

    /**
     * @param array $options
     *
     * @return HttpClientInterface
     */
    public function setOptions(array $options);

    /**
     * @param boolean $isEnabled
     *
     * @return HttpClientInterface
     */
    public function setSslVerification($isEnabled);

    /**
     * @param string $baseUri
     *
     * @return HttpClientInterface
     */
    public function setBaseUri($baseUri);

    /**
     * @param $contentType
     *
     * @return HttpClientInterface
     */
    public function setDefaultContentType($contentType);

    /**
     * Sends GET request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function get($endpoint, array $options = []);

    /**
     * Sends PATCH request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function patch($endpoint, array $options = []);

    /**
     * Sends PUT request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function put($endpoint, array $options = []);

    /**
     * Sends POST request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function post($endpoint, array $options = []);

    /**
     * Sends DELETE request
     *
     * @param string $endpoint
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function delete($endpoint, array $options = []);
}