<?php

namespace App\Models\Auth;

use App\Traits\Treat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Contracts\EntrustPermissionInterface;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;

class Permission extends Model implements EntrustPermissionInterface
{
    use EntrustPermissionTrait;
    use Treat;

    protected $table;

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('entrust.permissions_table');
    }

    public function scopeByName(Builder $builder, string $name)
    {
        return $builder
            ->where($this->table . '.name', $name)
            ->firstOrFail();
    }
}
