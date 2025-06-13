<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="User Management API",
 *     version="1.0.0",
 *     description="API documentation for managing users with CRUD, soft delete, bulk delete, and Excel export features.",
 *     @OA\Contact(
 *         email="yourname@example.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Main API Server"
 * )
 *

    * @OA\Get(
    *     path="/api/users",
    *     summary="Get list of users",
    *     tags={"Users"},
    *     @OA\Parameter(
    *         name="status",
    *         in="query",
    *         description="Filter by status (active/inactive)",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Response(response=200, description="Success")
    * )

    * @OA\Post(
     *     path="/api/users",
     *     summary="Create a new user",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "phone_number", "password", "status"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="phone_number", type="string", example="1234567890"),
     *             @OA\Property(property="password", type="string", example="secret123"),
     *             @OA\Property(property="status", type="string", example="active")
     *         )
     *     ),
     *     @OA\Response(response=200, description="User created")
     * )
     
    * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Get a specific user",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="User data or not found")
     * )
     
    * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Delete a user (soft delete)",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="User deleted")
     * )
     
    * @OA\Post(
     *     path="/api/users/bulk-delete",
     *     summary="Bulk delete users",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="ids",
     *                 type="array",
     *                 @OA\Items(type="integer"),
     *                 example={1, 2, 3}
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Users deleted")
     * ) 
 */
class OpenApi {}
