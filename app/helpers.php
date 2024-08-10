<?php
use Stichoza\GoogleTranslate\GoogleTranslate;

    function UnixTimeStampSeconds()
    {

        // Set the default time zone to Egypt
        date_default_timezone_set('Africa/Cairo');

        // Get the current Unix timestamp
        return time();
    }


    function calculateTimeDifference($startTime, $endTime)
    {
        // Calculate the difference in seconds
        $difference = abs($endTime - $startTime);

        // Calculate hours, minutes, and seconds
        $hours = floor($difference / 3600);
        $minutes = floor(($difference % 3600) / 60);
        $seconds = $difference % 60;

        // Format the result
        $timeDifference = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);

        return $timeDifference;
    }

    function convertTime($oTime)
    {
        $nTimeZone = 'Africa/Cairo';
        $originalTime = new DateTime();
        $originalTime->setTimestamp($oTime);
        $originalTime->setTimeZone(new DateTimeZone($nTimeZone));
        return $originalTime->format('H:i:s');
    }
    
    function sumTimes(array $times): string {
        // Initialize variables to hold total seconds for hours, minutes, and seconds
        $totalHours = 0;
        $totalMinutes = 0;
        $totalSeconds = 0;
    
        // Iterate through each time in the array
        foreach ($times as $time) {
            // Split the time into hours, minutes, and seconds
            list($hours, $minutes, $seconds) = explode(':', $time);
    
            // Add the time components to the total
            $totalHours += (int) $hours;
            $totalMinutes += (int) $minutes;
            $totalSeconds += (int) $seconds;
        }
    
        // Convert excess seconds and minutes to hours if needed
        $totalMinutes += floor($totalSeconds / 60);
        $totalSeconds %= 60;
        $totalHours += floor($totalMinutes / 60);
        $totalMinutes %= 60;
    
        // Format the total time as HH:MM:SS
        return sprintf('%02d:%02d:%02d', $totalHours, $totalMinutes, $totalSeconds);
    }
    
    function isTotalHoursLessThan($totalTime,$totalHours) {
        // Convert time string to seconds
        $seconds = strtotime($totalTime) - strtotime('TODAY');
        
        // Convert $totalHours hours to seconds
        $tenHoursInSeconds = $totalHours * 60 * 60; // $totalHours hours * 60 minutes * 60 seconds
    
        // Compare total time with $totalHours hours
        return $seconds < $tenHoursInSeconds;
    }

     function calculateTimePercent($totalHours, $remainingTime)
    {
        // Convert total hours to seconds
        $totalTimeInSeconds = $totalHours * 3600;
    
        // Convert remaining time to seconds
        list($hours, $minutes, $seconds) = explode(':', $remainingTime);
        $remainingTimeInSeconds = $hours * 3600 + $minutes * 60 + $seconds;
    
        // Calculate percentage
        $percentage = ($remainingTimeInSeconds / $totalTimeInSeconds) * 100;
    
        // Format total time
        $totalTimeFormatted = sprintf('%02d:%02d:%02d', floor($totalTimeInSeconds / 3600), floor(($totalTimeInSeconds % 3600) / 60), $totalTimeInSeconds % 60);
    
        // Format remaining time
        $remainingTimeFormatted = sprintf('%02d:%02d:%02d', floor($remainingTimeInSeconds / 3600), floor(($remainingTimeInSeconds % 3600) / 60), $remainingTimeInSeconds % 60);
    
        return [
            'totalTime' => $totalTimeFormatted,
            'remainingTime' => $remainingTimeFormatted,
            'percentage' => $percentage
        ];
    }
    
    if (!function_exists('translate')) {
        function translate($text, $targetLanguage = null)
        {
            try {
                // Use the provided target language if available, otherwise use the application locale
                $targetLanguage = $targetLanguage ?? app()->getLocale();
        
                // Get an instance of the GoogleTranslate class
                $translator = app(GoogleTranslate::class);
        
                // Translate the text to the target language
                return $translator->setTarget($targetLanguage)->translate($text);
            } catch (\Exception $e) {
                // Handle translation errors gracefully
                return "Translation Error: " . $e->getMessage();
            }
        }
    }
    

?>