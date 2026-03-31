<?php

namespace App\Services;

class CityNormalizer
{
    public function normalize(string $city): string
    {
        $city = mb_strtolower(trim($city));

        $city = str_replace([
            'г.',
            'г ',
            'город',
            'city',
        ], '', $city);

        $city = preg_replace('/\s+/u', ' ', $city);
        $city = trim($city);

        $normalizeName = $this->isLatin($city) ? $this->toCyrillic($city) : $city;

        return $this->formatName($normalizeName);
    }

    private function formatName(string $city): string
    {
        return mb_convert_case($city, MB_CASE_TITLE, 'UTF-8');
    }

    private function isLatin(string $text): bool
    {
        return preg_match('/[a-z]/i', $text) === 1;
    }

    private function toCyrillic(string $text): string
    {
        $text = mb_strtolower($text);

        $map = [
            // латиница → кириллица
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г',
            'd' => 'д',
            'e' => 'е',
            'yo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и',
            'y' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'h' => 'х',
            'c' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            'ya' => 'я',
            'yu' => 'ю',
            'ye' => 'е',
        ];

        $keys = array_keys($map);
        usort($keys, fn ($a, $b) => strlen($b) <=> strlen($a));

        foreach ($keys as $key) {
            $text = str_replace($key, $map[$key], $text);
        }

        return $text;
    }
}
