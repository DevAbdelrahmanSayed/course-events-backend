<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginatedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    private $resourceClass;

    public function __construct($resource, $resourceClass = null)
    {
        parent::__construct($resource);
        $this->resourceClass = $resourceClass;
    }

    public function toArray($request)
    {
        /** @var Paginator $paginator */
        $paginator = $this->resource;

        $data = $paginator->items();

        if ($this->resourceClass) {
            $data = array_map(function ($item) use ($request) {
                return (new $this->resourceClass($item))->toArray($request);
            }, $data);
        }

        return [
            'data' => $data,
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'has_more_pages' => $paginator->hasMorePages(),
                'next_page_url' => $paginator->nextPageUrl(),
                'prev_page_url' => $paginator->previousPageUrl(),
            ],
        ];
    }
}
