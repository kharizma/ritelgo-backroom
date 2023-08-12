<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    public const TYPE_STRING    = 'string';
    public const TYPE_INTEGER   = 'integer';

    public const TYPE = [
        self::TYPE_STRING,
        self::TYPE_INTEGER
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'variable',
        'is_technical',
        'value_type'
    ];
}
