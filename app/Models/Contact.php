<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc

class Contact extends Model
{
    use HasFactory;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 0;
<<<<<<< HEAD
=======
    public const TYPE_CONTACT = 1;
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc

    protected $fillable = [
        'name',
        'email',
        'phone',
<<<<<<< HEAD
        'type',
=======
        'type_id',
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
        'date_of_birth',
        'country_id',
        'center_id',
        'status',
<<<<<<< HEAD
        'address','city_id',
        'image',
=======
        'address',
        'city_id',
        'image',
        'avatar'
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
    ];
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
<<<<<<< HEAD
=======

    /**
     * Get the base path for images.
     * Can be reused anywhere.
     */
    public static function getBasePath($centerId)
    {
        return 'centers/' . $centerId . '/contacts';
    }
    /**
     * Get full public URL
     */
    public function getImageUrl($filePath)
    {
        return asset('storage/' . $filePath);
    }
    public function saveImage($image)
    {
        $basePath = self::getBasePath($this->center_id);

        // Delete old image if it exists
        if ($this->image) {
            FileHelper::deleteImage($this->image);
        }
        return FileHelper::saveBase64Image($image, $basePath);
    }
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
}
