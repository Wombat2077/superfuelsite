<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
        protected $fillable = [
            'content',
            'user_id'
        ];
         /**
         * Get the user that owns the comments
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user()
        {
            return User::find($this->user_id);
        }

}
