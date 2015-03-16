<?php

/**
 * @SWG\Resource(
 *  apiVersion="1.0",
 *  swaggerVersion="1.2",
 *  resourcePath="/contacts",
 *  basePath="/api/v1"
 * )
 */
class ApiV1ContactsController extends \BaseController {

    /**
     * @SWG\Api(
     *   path="/contacts",
     *   description="Operations on contacts",
     *   produces="['application/json']",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="List all the app users in the system",
     *       notes="Currently there is no pagination or filtering with additional query keys",
     *       type="Contact",
     *       nickname="index"
     *     )
     *   )
     * )
     */
    public function index()
    {
        return Response::json(Contact::all());
    }

    /**
     * @SWG\Api(
     *   path="/contacts",
     *   produces="['application/json']",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="Create a new contact",
     *       notes="",
     *       type="Contact",
     *       nickname="store",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="name",
     *           description="The name of the contact",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="number",
     *           description="Phone number of the contact",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function store()
    {
        $validator = Validator::make($data = Input::all(), Contact::$create_rules);

        if ($validator->fails())
        {
            return Response::json($validator->errors(),400);
        }

        $b = Contact::create($data);
        return Response::json($b->toArray());
    }

    /**
     * @SWG\Api(
     *   path="/contacts/{id}",
     *   description="",
     *   produces="['application/json']",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="Show a single app user by ID",
     *       notes="",
     *       type="Contact",
     *       nickname="showContact",
     *
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="id",
     *           description="ID of the user to be fetched",
     *           paramType="path",
     *           required=true,
     *           type="integer"
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function show($id)
    {
        $app_user = Contact::findOrFail($id);

        return Response::json($app_user);
    }

    /**
     * @SWG\Api(
     *   path="/contacts/{id}",
     *   description="",
     *   produces="['application/json']",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="Update a contact",
     *       notes="",
     *       type="Contact",
     *       nickname="update",
     *
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="id",
     *           description="ID of the contact to be updated",
     *           paramType="path",
     *           required=true,
     *           type="integer"
     *         ),
     *         @SWG\Parameter(
     *           name="name",
     *           description="Name of the contact",
     *           paramType="form",
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function update($id)
    {
        $contact = Contact::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Contact::$update_rules);

        if ($validator->fails())
        {
            return Response::json($validator->errors(),400);
        }

        $contact->update($data);

        return Response::json(null,204);
    }

    /**
     * @SWG\Api(
     *   path="/contacts/{id}",
     *   description="",
     *   produces="['application/json']",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="DELETE",
     *       summary="Delete an single contact by ID",
     *       notes="",
     *       type="Contact",
     *       nickname="destroy",
     *
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="id",
     *           description="ID of the contact to be deleted",
     *           paramType="path",
     *           required=true,
     *           type="integer"
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function destroy($id)
    {
        Contact::destroy($id);
        return Response::json(null,204);
    }

}