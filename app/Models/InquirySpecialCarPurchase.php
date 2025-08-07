<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\InquiryLog;
use App\Models\User;

class InquirySpecialCarPurchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'phone', 'first_name', 'last_name', 'car_brand', 'car_model', 'car_brand_id', 'car_model_id', 'car_year', 'delivery_location', 'description', 'status'
    ];

    public function logs(): MorphMany
    {
        return $this->morphMany(InquiryLog::class, 'inquiryable');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(VehicleBrand::class, 'car_brand_id');
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'car_model_id');
    }
}
