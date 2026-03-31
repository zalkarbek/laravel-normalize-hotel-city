<?php

namespace App\Services;

use App\Models\City;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;

readonly class HotelCityService
{
    public function __construct(
        private CityNormalizer $normalizer
    ) {}

    public function getCityByNameOrCreate(string $cityName): City
    {
        $city = City::query()->whereRaw('LOWER(name) = ?', [$cityName])->first();

        if ($city) {
            return $city;
        }

        return City::create([
            'name' => $cityName,
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function normalizeHotelCity(): string
    {
        DB::beginTransaction();

        try {
            $hotels = Hotel::all();

            foreach ($hotels as $hotel) {
                $normalizeCyrillicCityName = $this->normalizer->normalize($hotel->city);
                $city = $this->getCityByNameOrCreate($normalizeCyrillicCityName);

                $hotel->city_id = $city->id;
                $hotel->save();
            }

            DB::commit();

            return 'ok';
        } catch (\Throwable $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function rollbackHotelCity(): string
    {
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {

            $hotel->city_id = null;
            $hotel->save();
        }

        return 'ok';
    }
}
