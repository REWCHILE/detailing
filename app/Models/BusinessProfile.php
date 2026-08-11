<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class BusinessProfile extends Model
{
    protected $table = 'business_profiles';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Attributes that store sensitive credentials and are encrypted at rest.
     */
    private const ENCRYPTED_FIELDS = [
        'mercado_pago_access_token_test',
        'mercado_pago_access_token_production',
        'smtp_password',
    ];

    protected $fillable = [
        'id',
        'business_name',
        'logo',
        'email',
        'phone',
        'whatsapp',
        'instagram',
        'website',
        'google_maps_url',
        'google_analytics_id',
        'google_tag_manager_id',
        'header_scripts',
        'footer_scripts',
        'address_line1',
        'address_line2',
        'city',
        'region',
        'country_code',
        'timezone',
        'currency',
        'show_prices',
        'booking_hold_minutes',
        'slot_interval_minutes',
        'lead_time_hours',
        'max_advance_days',
        'payment_gateway_enabled',
        'payment_gateway_mode',
        'mercado_pago_public_key_test',
        'mercado_pago_access_token_test',
        'mercado_pago_public_key_production',
        'mercado_pago_access_token_production',
        'transbank_enabled',
        'transbank_mode',
        'transbank_commerce_code_test',
        'transbank_api_key_test',
        'transbank_commerce_code_production',
        'transbank_api_key_production',
        'smtp_enabled',
        'smtp_host',
        'smtp_port',
        'smtp_user',
        'smtp_password',
        'smtp_secure',
        'smtp_from_name',
        'smtp_from_email',
    ];

    protected $casts = [
        'booking_hold_minutes' => 'integer',
        'slot_interval_minutes' => 'integer',
        'lead_time_hours' => 'integer',
        'max_advance_days' => 'integer',
        'payment_gateway_enabled' => 'boolean',
        'transbank_enabled' => 'boolean',
        'show_prices' => 'boolean',
        'smtp_enabled' => 'boolean',
        'smtp_port' => 'integer',
        'smtp_secure' => 'boolean',
    ];

    /**
     * Override setAttribute to auto-encrypt sensitive fields on write.
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, self::ENCRYPTED_FIELDS) && !empty($value)) {
            $value = Crypt::encryptString($value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Override getAttribute to auto-decrypt sensitive fields on read.
     * Gracefully handles plaintext values that haven't been migrated yet.
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, self::ENCRYPTED_FIELDS) && !empty($value)) {
            try {
                return Crypt::decryptString($value);
            } catch (DecryptException $e) {
                // Value is still in plaintext (pre-migration), return as-is
                return $value;
            }
        }

        return $value;
    }
}

