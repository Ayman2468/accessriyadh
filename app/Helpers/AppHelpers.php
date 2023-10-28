<?php

namespace App\Helpers;


use Carbon\Carbon;


use Illuminate\Support\Facades\Storage;

class AppHelpers
{




    public static function download_file($path) {

        if (Storage::disk('local')->exists($path)) {
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $name = pathinfo($path, PATHINFO_FILENAME);

            return  Storage::disk('local')->download($path, $name . '.' . $extension, [
                'Content-Disposition' => 'inline; filename="' . $name . '.' . $extension . '"',
            ]);
        }

        abort('404');
    }

    public static function get_file_name($path, $name, $ext): string
    {

        $file_name = $path . $name . '.' . $ext;
        $index = 0;

        while (Storage::disk('local')->exists($file_name)) {
            $file_name = $path . $name . '_' . $index . '.' . $ext;
            $index++;
        }

        return $file_name;
    }

    public static function delete_file($path): string
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = pathinfo($path, PATHINFO_FILENAME);
        $dir = dirname($path) . '/removed/';
        $full_name = self::get_file_name($dir, $file_name, $ext);

        Storage::disk('local')->move($path, $full_name);
        return $full_name;
    }

    public static function formatSizeUnits($bytes): string
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public static function get_mpdf($format = 'A4' , $orientation = 'P'): \Mpdf\Mpdf
    {
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();

        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new  \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => $format,
            'orientation' => $orientation,
            'autoArabic' => true,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_header' => 0,
            'margin_footer' => 0,
            'fontDir' => array_merge($fontDirs, [
                public_path('fonts'),
            ]),
            'fontdata' => $fontData + [
                    'tajawal' => [
                        'R' => 'Tajawal-Regular.ttf',
                        'T' => 'Tajawal-Regular.ttf',
                        'TI' => 'Tajawal-Regular.ttf',
                        'B' => 'Tajawal-Bold.ttf',
                        'BI' => 'Tajawal-Bold.ttf',
                        'SB' => 'Tajawal-Bold.ttf',
                        'SBI' => 'Tajawal-Bold.ttf',
                        'I' => 'Tajawal-Regular.ttf',
                        'L' => 'Tajawal-Light.ttf',
                        'LI' => 'Tajawal-Light.ttf',
                        'useOTL' => 0xFF,
                        'useKashida' => 75,
                    ], 'bahij' => [
                        'R' => 'Bahij_TheSansArabic-Bold.ttf',
                        'T' => 'Bahij_TheSansArabic-Bold.ttf',
                        'TI' => 'Bahij_TheSansArabic-Bold.ttf',
                        'B' => 'Bahij_TheSansArabic-Bold.ttf',
                        'BI' => 'Bahij_TheSansArabic-Bold.ttf',
                        'SB' => 'Bahij_TheSansArabic-Bold.ttf',
                        'SBI' => 'Bahij_TheSansArabic-Bold.ttf',
                        'I' => 'Bahij_TheSansArabic-Bold.ttf',
                        'L' => 'Bahij_TheSansArabic-Bold.ttf',
                        'LI' => 'Bahij_TheSansArabic-Bold.ttf',
                        'useOTL' => 0xFF,
                        'useKashida' => 75,
                    ]
                ],
            'default_font' => 'tajawal',
        ]);
        $mpdf->showImageErrors = true;
        $mpdf->autoScriptToLang = true;
        return $mpdf;
    }





}
