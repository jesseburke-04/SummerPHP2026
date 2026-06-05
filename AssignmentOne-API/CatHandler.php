<?php
    /*
    Cat Handler Class:
    This is the blueprint for the API fetches
    */
    class CatHandler {
        private $targetUrl;
        private $securityKey;
 
        public function __construct($incomingUrl, $incomingKey) {
            $this->targetUrl = $incomingUrl;
            $this->securityKey = $incomingKey;
        }
 
        /*
        This pulls the cat dataset from the API
        // The Cat API requires the key as a request header, not a URL parameter
        */
        public function fetchCats($selectedPage = 0, $limit = 10) {
            // Constructing the string with newly assigned class properties
            $endpointUrl = "{$this->targetUrl}/images/search?limit=" . intval($limit) . "&page=" . intval($selectedPage) . "&order=RANDOM&has_breeds=1";
 
            $context = stream_context_create([
                "http" => [
                    "header" => "x-api-key: {$this->securityKey}\r\n"
                ]
            ]);
 
            $rawJsonString = @file_get_contents($endpointUrl, false, $context);
            if ($rawJsonString === false) {
                return [];
            }
 
            $decodedPayload = json_decode($rawJsonString);
            return $decodedPayload ?? [];
        }
    }
?>