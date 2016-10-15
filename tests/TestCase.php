<?php

class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    protected function getWithAuth($uri)
    {
        $response = $this->call('GET', $uri, array(), array(), array(), $this->transformHeadersToServerVars(['Authorization' => $this->getToken()]));
        return $response->getContent();
    }

    protected function postWithAuth($uri, $content)
    {
        $response = $this->call('POST', $uri, array(), array(), array(),
            $this->transformHeadersToServerVars(['Authorization' => $this->getToken(), 'CONTENT_TYPE' => 'application/json']),
            $content);
        return $response->getContent();
    }

    protected function putWithAuth($uri, $content)
    {
        $response = $this->call('PUT', $uri, array(), array(), array(),
            $this->transformHeadersToServerVars(['Authorization' => $this->getToken(), 'CONTENT_TYPE' => 'application/json']),
            $content);
        return $response->getContent();
    }

    protected function deleteWithAuth($uri)
    {
        $response = $this->call('DELETE', $uri, array(), array(), array(),
            $this->transformHeadersToServerVars(['Authorization' => $this->getToken()]));
        return $response->getContent();
    }

    protected function getToken()
    {
        $json = '{"username":"Alice","password":"abc123"}';
        $tokenResponse = $this->call('POST', '/api/user/login', array(), array(), array(), ['CONTENT_TYPE' => 'application/json'], $json)->content();
        $token = json_decode($tokenResponse, true)['token'];
        return $token;
    }

    protected function getNow()
    {
        $newExpiry = new \DateTime();
        $newExpiry->setTimestamp((new \DateTime())->getTimestamp() + 3600);
        return $newExpiry->format('Y-m-d H:i:s');
    }
}
