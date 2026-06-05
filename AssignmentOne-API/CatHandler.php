<?php
    /*
    Cat Handler Class:
    This is the blueprint for the API fetches
    */
    class CatHandler {
        private $targetUrl;
        private $securityKey;

        //The constructor stores the URL and key.
        public function __construct($incomingUrl, $incomingKey) {
            $this->targetUrl = $incomingUrl;
            $this->securityKey = $incomingKey;
        }
 
        /*
        This pulls the cat dataset from the API
        */
        public function fetchCats($selectedPage = 0, $limit = 10) {
            //constructing the string with newly assigned class properties
            $endpointUrl = "{$this->targetUrl}/images/search?limit=" . intval($limit) . "&page=" . intval($selectedPage) . "&order=RANDOM&has_breeds=1";
            //The Cat API requires the API key in the header.
            $context = stream_context_create([
                "http" => [
                    "header" => "x-api-key: {$this->securityKey}\r\n"
                ]
            ]);
 
            $rawJsonString = @file_get_contents($endpointUrl, false, $context);
            if ($rawJsonString === false) {
                return [];
            }
            // Decodes the JSON response and returns it.
            $decodedPayload = json_decode($rawJsonString);
            return $decodedPayload ?? [];
        }
    }
?>