<?php

    namespace App\traits;


    use Illuminate\Http\JsonResponse;

    trait ApiResponses
    {
        protected function ok($message, $data = [], $statusCode = 200): JsonResponse {
            return $this->success($message, $data, $statusCode);
        }

        protected function success($message, $data = [], $statusCode = 200): JsonResponse {
            return response()->json([

                'message' => $message,
                'status'  => $statusCode,
                'data'    => $data
            ], $statusCode);
        }

        protected function error($message, $statusCode, $responseStatus): JsonResponse {
            return response()->json([
                'status'  => $responseStatus,
                'errors'  => [
                    'generic' => $message,
                ],
                'message' => $message

            ], $statusCode);
        }
    }

