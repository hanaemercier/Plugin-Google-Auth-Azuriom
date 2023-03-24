<?php

namespace Azuriom\Plugin\GoogleAuth\Models;


class User extends \Azuriom\Models\User
{
    public function google() {
        return $this->belongsTo(Google::class);
    }
}