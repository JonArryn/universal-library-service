<?php

    namespace App\traits;


    use Illuminate\Http\JsonResponse;

    trait ApiResponses
    {
        protected function ok(string $message, array $data = [], int $statusCode = 200): JsonResponse {
            return $this->success($message, $data, $statusCode);
        }

        protected function success(string $message, array $data = [], int $statusCode = 200): JsonResponse {
            return response()->json([

                'message' => $message,
                'status'  => $statusCode,
                'data'    => $data
            ], $statusCode);
        }

        protected function error(string $message, int $statusCode, int $responseStatus): JsonResponse {
            return response()->json([
                'status'  => $responseStatus,
                'errors'  => [
                    'generic' => [$message],
                ],
                'message' => $message

            ], $statusCode);
        }

        protected function notAuthorized($message = "You are not authorized to perform this action.") {
            return $this->error($message, 403, 403);
        }
    }

