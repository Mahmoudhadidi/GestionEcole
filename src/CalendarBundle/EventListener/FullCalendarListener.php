<?php

namespace CalendarBundle\EventListener;

use Calendar\Repository\SeancecalendarRepository;
use Doctrine\ORM\EntityManager;
use SeanceBundle\Entity\Seance;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Toiba\FullCalendarBundle\Entity\Event;
use Toiba\FullCalendarBundle\Event\CalendarEvent;

class FullCalendarListener
{


    /**
     * @param CalendarEvent $calendar
     *
     * @return FullCalendarEvent[]
     */


    public function loadEvents(CalendarEvent $calendar)
    {
        $startDate = $calendar->getStart();
        $endDate = $calendar->getEnd();
        $filters = $calendar->getFilters();

        $calendar->addEvent(new Event(
            'mobile',
            new \DateTime('Tuesday this week'),
            new \DateTime('Wednesdays this week')
        ));

        // If the end date is null or not defined, it creates a all day event
        $calendar->addEvent(new Event(
            'GL',
            new \DateTime('Friday this week')
        ));
        $calendar->addEvent(new Event(
            'Reseau',
            new \DateTime('Friday this week')
        ));
        $calendar->addEvent(new Event(
            'Math',
            new \DateTime('Friday this week')
        ));
    }
}