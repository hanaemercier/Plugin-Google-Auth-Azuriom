<?php

namespace Azuriom\Plugin\GoogleAuth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Google
 *
 * @property $id
 * @property $google_id
 * @property $user_id
 *
 * @package Azuriom\Plugin\DiscordAuth\Controllers\Models
 */
class Google extends Model
{

    public function user() {
        return $this->belongsTo(User::class);
    }
}