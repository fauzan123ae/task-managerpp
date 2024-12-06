<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Models\TaskHistory;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    // Tentukan atribut yang dapat diisi (mass assignable)
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'user_id',
        'category_id',
    ];

    // Cast 'due_date' dan 'deleted_at' ke instance Carbon
    protected $dates = [
        'due_date',
        'deleted_at',
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definisikan relasi dengan model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Definisikan relasi polimorfik dengan model TaskHistory
    public function histories()
    {
        return $this->morphMany(TaskHistory::class, 'historable');
    }

    // Metode untuk mengubah status tugas dan mencatat riwayat
    public function changeStatus($newStatus, $description = null)
    {
        if ($this->status !== $newStatus) {
            $this->histories()->create([
                'status' => $newStatus,
                'description' => $description,
            ]);

            $this->status = $newStatus;
            $this->save();
        }
    }

    // Scope untuk memfilter tugas berdasarkan status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
