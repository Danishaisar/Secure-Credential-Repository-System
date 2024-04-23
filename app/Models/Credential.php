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
            // Log the exception or handle the error as per your requirements
            \Log::error("Error decrypting password: " . $e->getMessage());
            // Return an empty string or handle as needed
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
