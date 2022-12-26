<?php

namespace Models;

use OpenApi\Annotations\OpenApi as OA;

/**
 * @OA\Info (title="Пример доки к API", version="1.0.0")
 */
interface IUser
{
    /**
     * @OA\Post(
     *     tags={"Users"},
     *     path="/users",
     *     summary="Add a new user",
     *     description="Add a new user to the store",
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Invalid input",
     *     )
     * )
     */
    public function addUserToDB(): void;

    /**
     * @OA\Get(
     *     tags={"Users"},
     *     path="/users",
     *     summary="Get all users",
     *     description="returns all registered users",
     *     @OA\Parameter (
     *          in="query",
     *          name="Page number",
     *          description="number of page to return",
     *          @OA\Schema(
     *              type="integer",
     *              format="int32"
     *          ),
     *      ),
     *     @OA\Parameter (
     *          in="query",
     *          name="Page size",
     *          description="max number of users to return",
     *          @OA\Schema(
     *              type="integer",
     *              format="int32"
     *          ),
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="All the user",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Message not found",
     *     )
     * )
     */
    public function showAllUsersFromDB($offset, $size_page): array;

    /**
     * @OA\Get(
     *     tags={"Users"},
     *     path="/users/{userId}",
     *     summary="Find user by ID",
     *     description="Returns a single user",
     *     @OA\Parameter (
     *          in="path",
     *          name="userId",
     *          description="ID of user to return",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          ),
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="User by id",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function showUserByID($id): User;

    /**
     * @OA\Delete(
     *     tags={"Users"},
     *     path="/users/{userId}",
     *     summary="Delete a user by ID",
     *     description="Deletes a user by ID",
     *     @OA\Parameter (
     *          in="path",
     *          name="userId",
     *          description="ID of user to delete",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          ),
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Invalid user ID"
     *     )
     * )
     */
    public function deleteUserFromDB($id): void;

    /**
     * @OA\Put(
     *     tags={"Users"},
     *     path="/users/{userId}",
     *     summary="Updates a user with form data",
     *     description="Updates a user",
     *     @OA\Parameter (
     *          in="path",
     *          name="userId",
     *          description="ID of user that needs to be updated",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          ),
     *      ),
     *     @OA\Parameter (
     *          in="query",
     *          name="name",
     *          description="Name of user that needs to be updated",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *     @OA\Parameter (
     *          in="query",
     *          name="email",
     *          description="Email of user that needs to be updated",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *     @OA\Parameter (
     *          in="query",
     *          name="gender",
     *          description="Gender of user that needs to be updated",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *     @OA\Parameter (
     *          in="query",
     *          name="status",
     *          description="Status of user that needs to be updated",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *     @OA\Response(
     *          response=405,
     *          description="Invalid input"
     *     )
     * )
     */
    public function editUserInfoInDB($user): void;
}