<?php
class CatHandler {
    private string $baseUrl;
    private string $apiKey;
 
    public function __construct(string $baseUrl, string $apiKey) {
        $this->baseUrl = $baseUrl;
        $this->apiKey  = $apiKey;
    }
 
    public function fetchCats(int $page = 0, int $limit = 10): array {
        $url = "{$this->baseUrl}/images/search?limit=" . $limit . "&page=" . $page . "&order=RANDOM&has_breeds=1";
 
        $context = stream_context_create([
            "http" => [
                "header" => "x-api-key: {$this->apiKey}\r\n"
            ]
        ]);
 
        $json = file_get_contents($url, false, $context);
        if ($json === false) {
            return [];
        }
 
        return json_decode($json) ?? [];
    }
}
?>