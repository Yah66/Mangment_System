<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'conversation_id',
        'user_id',
        'body',
        'type',
    ];

    /**
     * Get the user that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'foreign_key', 'other_key');
    }
    /**
     * Get the user that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(
            [
                'name'=>"user"
            ]
        );
    }
     /**
      * The roles that belong to the Message
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
      */
    public function recipients()
    {
        return $this->belongsToMany(User::class, 'recipients')->withPivot(['read_at','deleted_at']);
    }
}
