<?php


function responseJson($response_status, $massage, $object = null, $pagination = null)
{
    $response = [
        'message' => $massage,
        'data' => $object,
        'pagination' => $pagination,
    ];

    return response()->json($response, $response_status);
}


function getPaginates($collection)
{
    return [
        'per_page' => $collection->perPage(),
        'path' => $collection->path(),
        'total' => $collection->total(),
        'current_page' => $collection->currentPage(),
        'next_page_url' => $collection->nextPageUrl(),
        'previous_page_url' => $collection->previousPageUrl(),
        'last_page' => $collection->lastPage(),
        'has_more_pages' => $collection->hasMorePages(),
        'from' => $collection->firstItem(),
        'to' => $collection->lastItem(),
    ];
}
