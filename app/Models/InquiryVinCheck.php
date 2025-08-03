<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\InquiryLog;

class InquiryVinCheck extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'phone', 'first_name', 'last_name', 'vin_number', 'description', 'status'
    ];

    public function logs(): MorphMany
    {
        return $this->morphMany(InquiryLog::class, 'inquiryable');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
