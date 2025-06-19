<?php

namespace App\Services\Admin;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class CountryService
{
    public function getPaginatedCountries(int $perPage): Paginator
    {
        return Country::latest('id')
            ->select(
                'name',
                'name_ar',
                'slug',
                'content',
                'currency',
                'created_at',
                'updated_at'
            )
            ->simplePaginate($perPage);
    }

    public function create(array $data): Country
    {
        $data['admin_id'] = auth('admin')->id();

        return Country::create($data);
    }

    public function update(Country $country, array $data): Country
    {
        $data['admin_id'] = auth('admin')->id();
        $country->update($data);

        return $country->fresh();
    }

    public function delete(Country $country): bool
    {
        return $country->delete();
    }

    public function getAllForDropdown(): Collection
    {
        return Country::orderBy('name')
            ->select(
                'name',
                'slug',
                'currency',
            )
            ->get();

    }
}
