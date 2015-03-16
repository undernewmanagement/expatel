<?php

/**
 * @SWG\Resource(
 *  apiVersion="1.0",
 *  swaggerVersion="1.2",
 *  resourcePath="/messages",
 *  basePath="/api/v1"
 * )
 */
class ApiV1MessagesController extends \BaseController {

    /**
     * @SWG\Api(
     *   path="/messages",
     *   produces="['application/json']",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="Create a new message",
     *       notes="",
     *       type="Message",
     *       nickname="store",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="content",
     *           description="The content of the message",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="id",
     *           description="The id of the owning contact",
     *           paramType="form",
     *           required=true,
     *           type="integer"
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function store()
    {
        $data = Input::all();

        $validator = Validator::make($data, Message::$create_rules);

        if ($validator->fails())
        {
            return Response::json($validator->errors(),400);
        }

        $data['is_inbound'] = false;
        $b = Message::create($data);
        Twilio::sendMessage($b->contact->number, $b->content);
        return Response::json($b->toArray());
    }

    /**
     * @SWG\Api(
     *   path="/messages",
     *   description="Operations on messages",
     *   produces="['application/json']",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="List all the messages for a given contact",
     *       notes="Currently there is no pagination or filtering with additional query keys",
     *       type="Message",
     *       nickname="index",
     *
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="contact_id",
     *           description="The ID of the owning contact",
     *           paramType="form",
     *           required=true,
     *           type="integer"
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        $contact_id = Input::get('contact_id');

        # Update messages read
        Message::where('contact_id','=',$contact_id)->update(['is_read' => true]);

        $messages = Message::where('contact_id','=',$contact_id)->orderBy('created_at','desc')->limit(10)->get();

        return Response::json($messages);
    }

    public function inbound_twilio() {
        $to = Input::get('To');
        $from = Input::get('From');
        $body = Input::get('Body');

        $contact = Contact::firstorCreate(['number' => $from]);

        Message::create([
            'contact_id' => $contact->id,
            'content'    => $body,
            'is_inbound' => true
        ]);

        return Response::json(null,201);
    }

}
