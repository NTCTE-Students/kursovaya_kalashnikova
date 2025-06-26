<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Theme extends Model
{
        protected $fillable = [
        'title',
        'content',
    ];
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
