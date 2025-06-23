<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'brand_name',
        'content',
        'is_published',
        'landing_page_template_id',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Get the user that owns the landing page.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the template used for this landing page.
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(LandingPageTemplate::class, 'landing_page_template_id');
    }
    
    /**
     * Get section templates from content
     */
    public function getSectionTemplates()
    {
        if (empty($this->content)) {
            return [];
        }
        
        return $this->content;
    }
} 