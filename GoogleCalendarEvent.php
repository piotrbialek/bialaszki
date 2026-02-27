<?php

class GoogleCalendarEvent
{
    public function createGoogleCalendarLink(
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

        $startDateUTC = clone $startDate;
        $startDateUTC->setTimezone(new \DateTimeZone('UTC'));
        $endDateUTC = clone $endDate;
        $endDateUTC->setTimezone(new \DateTimeZone('UTC'));

        $startFormatted = $startDateUTC->format('Ymd\THis\Z');
        $endFormatted = $endDateUTC->format('Ymd\THis\Z');

        $params = [
            'action' => 'TEMPLATE',
            'text' => $title,
            'details' => $description,
            'dates' => $startFormatted . '/' . $endFormatted,
            'location' => $location,
            'remind' => 'on',
            'sf' => 'true',
            'output' => 'xml',
        ];

        $baseUrl = 'https://calendar.google.com/calendar/render';
        $queryString = http_build_query($params);

        return $baseUrl . '?' . $queryString;
    }
}