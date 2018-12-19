<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/16
 * Time: 下午23:58
 */

namespace App\Support;

use League\Fractal\TransformerAbstract;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

/**
 * Class Response
 * @package App\Support
 */
class Response
{
    /**
     * HTTP Response.
     *
     * @var \Illuminate\Contracts\Routing\ResponseFactory
     */
    private $response;

    /**
     * API transformer helper.
     *
     * @var \App\Support\Transform
     */
    public $transform;

    /**
     * HTTP status code.
     *
     * @var int
     */
    private $statusCode = HttpResponse::HTTP_OK;

    private $status = true;

    /**
     * Create a new class instance.
     *
     * @param $response
     * @param $transform
     */
    public function __construct(ResponseFactory $response, Transform $transform)
    {
        $this->response = $response;
        $this->transform = $transform;
    }

    /**
     * Return a 201 response with the given created resource.
     *
     * @param null $resource
     * @param TransformerAbstract|null $transformer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withCreated($resource = null, TransformerAbstract $transformer = null): \Illuminate\Http\JsonResponse
    {
        $this->statusCode = HttpResponse::HTTP_CREATED;

        if ($resource === null) {
            return $this->json();
        }

        return $this->item($resource, $transformer);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function withPutted(): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_NO_CONTENT)->json();
    }

    /**
     * Make a 204 no content response.
     * eg: delete resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withNoContent(): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_NO_CONTENT)->json();
    }

    /**
     * Make a 400 'Bad Request' response.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withBadRequest($message = 'Tengine: Bad Request'): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_BAD_REQUEST)->withError($message);
    }

    /**
     * Make a 401 'Unauthorized' response.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withUnauthorized($message = 'Unauthorized'): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_UNAUTHORIZED)->withError($message);
    }

    /**
     * Make a 403 'Forbidden' response.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withForbidden($message = 'Tengine: Forbidden'): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_FORBIDDEN)->withError($message);
    }

    /**
     * Make a 404 'Not Found' response.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withNotFound($message = 'Not Found'): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_NOT_FOUND)->withError($message);
    }

    /**
     * Make a 429 'Too Many Requests' response.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withTooManyRequests($message = 'Too Many Requests'): \Illuminate\Http\JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_TOO_MANY_REQUESTS)->withError($message);
    }

    /**
     * Make a 500 'Internal Server Error' response.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withInternalServer($message = 'Internal Tengine Server Error')
    {
        return $this->setStatusCode(
            HttpResponse::HTTP_INTERNAL_SERVER_ERROR
        )->withError($message);
    }

    /**
     * Make an error response.
     *
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withError($message = 'Something Error'): \Illuminate\Http\JsonResponse
    {
        return $this->json(['message' => $message, 'status' => $this->status]);
    }

    /**
     * Make a JSON response with the transformed items.
     *
     * @param $item
     * @param TransformerAbstract|null $transformer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function item($item, TransformerAbstract $transformer = null): \Illuminate\Http\JsonResponse
    {
        return $this->json($this->transform->item($item, $transformer));
    }

    /**
     * Make a JSON response.
     *
     * @param $items
     * @param TransformerAbstract|null $transformer
     * @throws \Exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function collection($items, TransformerAbstract $transformer = null): \Illuminate\Http\JsonResponse
    {
        return $this->json($this->transform->collection($items, $transformer));
    }

    /**
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function json($data = [], array $headers = []): \Illuminate\Http\JsonResponse
    {
        $data['status'] = $this->status;
        return $this->response->json($data, $this->statusCode, $headers);
    }

    /**
     * Set HTTP status code.
     *
     * @param int $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode): self
    {
        $this->statusCode = $statusCode;

        if ($statusCode <= 200 && $statusCode > 300) {
            $this->status = false;
        }

        return $this;
    }

    /**
     * Gets the HTTP status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
