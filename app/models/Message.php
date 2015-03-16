<?php
/**
 *
 * @SWG\Model(id="Message")
 *
 * @SWG\Property(
 *  name="id",
 *  type="integer",
 *  description="The ID of the message"
 * )
 *
 * @SWG\Property(
 *  name="content",
 *  type="string",
 *  required=true,
 *  description="The content of the message"
 * )
 *
 * @SWG\Property(
 *  name="is_read",
 *  type="boolean",
 *  description="Has the message been read yet? True or false"
 * )
 *
 * @SWG\Property(
 *  name="contact_id",
 *  type="integer",
 *  description="The related contact this message belongs to"
 * )
 *
 */
class Message extends \Eloquent {

    // Add your validation rules here
    public static $create_rules = [
        'content' => 'required',
        'contact_id' => 'required'
    ];

    public static $update_rules = [

    ];


    // Don't forget to fill this array
    protected $fillable = [
        'content',
        'contact_id',
        'is_read',
        'is_inbound'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function contact()
    {
        return $this->belongsTo('Contact','contact_id');
    }

}