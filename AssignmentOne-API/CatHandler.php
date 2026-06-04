<?php
class CatHandler {
    private $targetUrl;
    private $securityKey;

    public function __construct($incomingUrl, $incomingKey) {
        $this->targetUrl = $incomingUrl;
        $this->securityKey = $incomingKey;
    }

    public function fetchCats($selectedPage = 0, $limit = 10) {
        $endpointUrl = "{$this->targetUrl}/images/search?limit=" . intval($limit) . "&page=" . intval($selectedPage) . "&order=RANDOM";

        $context = stream_context_create([
            "http" => [
                "header" => "x-api-key: {$this->securityKey}\r\n"
            ]
        ]);

        $rawJsonString = @file_get_contents($endpointUrl, false, $context);
        if ($rawJsonString === false) {
            return [];
        }

        return json_decode($rawJsonString) ?? [];
    }
}
?>