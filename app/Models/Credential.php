<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Credential extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'password',
        'description',
    ];

    /**
     * Automatically decrypt password when retrieved.
     *
     * @param  string  $value
     * @return string
     */
    public function getPasswordAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            \Log::error("Error decrypting password: " . $e->getMessage());
            return '';
        }
    }

    /**
     * Automatically encrypt password before saving to the database.
     *
     * @param  string  $value
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Crypt::encryptString($value);
        }
    }
}
