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

        $selects = [];
        // Build the select list: the header of the query result will have the list of fields (ids) and then values will be located at the same level.
        // as result we will have in one row all the values of the person.
        foreach ($attributes as $attribute) {
            // Select the value for the associate field and the current record (current record in the context of the query)
            $selects[] = "(SELECT {$attribute->column_name} FROM values where custom_attribute_id = {$attribute->id} and values.person_id = people.id) as {$attribute->name}";
        }

        $selects = implode(',', $selects);

        $query->selectRaw("{$selects}");
    }
}
