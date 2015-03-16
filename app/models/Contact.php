<?php
/**
 *
 * @SWG\Model(id="Contact")
 *
 * @SWG\Property(
 *  name="id",
 *  type="integer",
 *  description="The ID of the contact"
 * )
 *
 * @SWG\Property(
 *  name="name",
 *  type="string",
 *  required=true,
 *  description="The name of the contact"
 * )
 *
 * @SWG\Property(
 *  name="number",
 *  type="string",
 *  required=true,
 *  description="The contacts phone number (freeform)"
 * )
 *
 */

// http://stackoverflow.com/questions/23136898/how-do-i-create-an-accessor-for-a-point-data-column-in-a-laravel-4-model
class Contact extends \Eloquent {

    // Add your validation rules here
    public static $create_rules = [
        'name'   => 'required',
        'number' => 'required'
    ];

    public static $update_rules = [
    ];

    // Don't forget to fill this array
    protected $fillable = [
        'name',
        'number'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    protected $appends = array('unread_count');

    public function messages()
    {
        return $this->hasMany('Message');
    }


    public function getUnreadCountAttribute() {
        return $this->messages()->where('is_read','=',false)->count();
    }
}