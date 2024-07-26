<?php 

    namespace App\Utils;

    class Response {
        public function setSimpleResponse(int $httpCode, string $message) {
            $response = [
                'success' => false,
                'message' => $message
            ];

            if ($httpCode === 200 || $httpCode === 204) {
                $response['success'] = true;
            }
            $this->simpleResponse($httpCode, $response);
        }

        public function setObjectResponse(int $httpCode, array $object) {
            $response = [
                'succes' => false,
                'data' => $object
            ];

            if($httpCode === 200) {
                $response['sucess'] = true;
            }
            $this->objectResponse($httpCode, $response);
        }

        public function simpleResponse(int $httpCode, array $response) {
            http_response_code($httpCode);
            echo json_encode($response);
            exit();
        }

        public function objectResponse(int $httpCode, array $object) {            
            http_response_code($httpCode);
            echo json_encode($object);
            exit();
        }

        public function getItemRequestId() {
            return intval(basename($_SERVER['REQUEST_URI']));
        }

        public function getDataRequest() {
            return json_decode(file_get_contents('php://input'), true);
        }
    }

?>