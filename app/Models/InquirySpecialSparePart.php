<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\InquiryLog;

class InquirySpecialSparePart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'phone', 'first_name', 'last_name', 'part_name', 'car_brand', 'car_model', 'car_year', 'description', 'status'
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
