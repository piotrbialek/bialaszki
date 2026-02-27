<?php

class AppleCalendarEvent
{
    public function createAppleCalendarLink(
        string $title,
        string $description,
        string $location,
        string $startDateTime,
        string $endDateTime,
        string $timezone = 'Europe/Warsaw'
    ) {
        $tz = new \DateTimeZone($timezone);
        $startDate = new \DateTime($startDateTime, $tz);
        $endDate = new \DateTime($endDateTime, $tz);

        $startFormatted = $startDate->format('Ymd\THis');
        $endFormatted = $endDate->format('Ymd\THis');

        $escapedDescription = $this->escapeICSString($description);
        $escapedLocation = $this->escapeICSString($location);

        $ics = "BEGIN:VCALENDAR\r\n";
        $ics .= "VERSION:2.0\r\n";
        $ics .= "BEGIN:VEVENT\r\n";
        $ics .= "DTSTART;TZID={$timezone}:{$startFormatted}\r\n";
        $ics .= "DTEND;TZID={$timezone}:{$endFormatted}\r\n";
        $ics .= "SUMMARY:{$title}\r\n";
        $ics .= "DESCRIPTION:{$escapedDescription}\r\n";
        $ics .= "LOCATION:{$escapedLocation}\r\n";
        $ics .= "BEGIN:VALARM\r\n";
        $ics .= "ACTION:DISPLAY\r\n";
        $ics .= "DESCRIPTION:Przypomnienie o wydarzeniu\r\n";
        $ics .= "TRIGGER:-P7D\r\n";
        $ics .= "END:VALARM\r\n";
        $ics .= "END:VEVENT\r\n";
        $ics .= "END:VCALENDAR";

        $icsEncoded = rawurlencode($ics);
        return "data:text/calendar;charset=utf8,{$icsEncoded}";
    }

    private function escapeICSString($string)
    {
        // Escape specjalnych znaków dla formatu ICS
        $string = str_replace("\\", "\\\\", $string);
        $string = str_replace(",", "\\,", $string);
        $string = str_replace(";", "\\;", $string);
        $string = str_replace("\n", "\\n", $string);
        $string = str_replace("\r", "", $string);

        return $string;
    }
}
