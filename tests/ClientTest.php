<?php

class ClientTest extends TestCase
{
    /**
     * Test to get all of the clients.
     *
     * @return void
     */
    public function testGetAll()
    {
        $this->assertEquals(
            "[{\"id\":1,\"name\":\"Pear LLC\",\"phone\":\"123321123\",\"discount\":0,\"created_at\":null,\"updated_at\""
        .":null},{\"id\":2,\"name\":\"AEKI\",\"phone\":\"0987654321\",\"discount\":75,\"created_at\":null,\"updated_at\""
        .":null}]", $this->getWithAuth('/api/client')
        );
    }

    private function getWithAuth($uri) {
        $response = $this->call('GET', $uri, [], [], [
            'Authorization' => $this->getToken()
        ]);
        return $response->getContent();
    }

    private function getToken() {
        $tokenResponse = $this->call('POST', '/api/user/login', [
            "username"    => "Alice",
            "password"     => "abc123"
        ], [], [], [])->content();
        $token =  json_decode($tokenResponse, true)['token'];
        return $token;
    }
}
