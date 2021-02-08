<?php

namespace App\Interfaces;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface IHueItem
{
    /**
     * HueItem constructor.
     *
     * @param string $category
     */
    public function __construct(string $category);

    /**
     * @param array       $params
     * @param string|null $filter
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function all(array $params = [], string $filter = null);

    /**
     * @param int|string $id
     * @param array      $params
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function byID(int $id, array $params = []);

    /**
     * @param array $params
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function save(array $params = []);

    /**
     * @param Request     $request
     * @param int         $id
     * @param string|null $custom
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function update(Request $request, int $id, string $custom = null);

    /**
     * @param int $id
     *
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function delete(int $id);
}
