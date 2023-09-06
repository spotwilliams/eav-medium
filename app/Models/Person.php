<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Person extends Model
{
    protected $table = 'people';

    use HasFactory;

    public function values(): HasMany
    {
        return $this->hasMany(Value::class);
    }

    public function scopeWithCustomAttributes(Builder $query): void
    {
        /** @var Collection<CustomAttribute> $attributes */
        $attributes = CustomAttribute::all();

        // Build the select list: the header of the query result will have the list of fields (ids) and the values will be located at the same level.
        // as result, we will have in one row all the values of the person.
        foreach ($attributes as $attribute) {
            $query->addSelect([
                // The key will append a new attribute on the resultant model with the name of the attribute
                $attribute->name => Value::query()
                    // Only select the column that the attribute indicates
                    ->select($attribute->column_name)
                    // Filter the attributes by person
                    ->whereColumn('values.person_id', '=', 'people.id')
                    // Only choose the attribute indicated here
                    ->where('values.custom_attribute_id', '=', $attribute->id)
            ]);
        }
    }
}
