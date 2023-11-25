<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 *
 * @property int $id
 * @property string $refresh_token
 * @property string $access_token
 * @property string $expires_at
 * @property string $token_type
 * @property string api_domain
 * @property string created_at
 * @property string updated_at
 */
class ZohoOauthToken extends Model
{
    use HasFactory;

    public $table = "zoho_oauth";
}
