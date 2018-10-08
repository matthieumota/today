<?php

/*
 * This file is part of the Today package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MatthieuMota\Component\Today;

/**
 * Class Today
 * @package MatthieuMota\Component\Today
 * @author Matthieu Mota <matthieu@boxydev.com>
 */
class Today
{
    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * Today constructor.
     *
     * @param \DateTimeInterface|null $date
     */
    public function __construct(\DateTimeInterface $date = null)
    {
        $this->date = $date ?? new \DateTime();
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Get all holidays.
     *
     * @return array
     */
    public function getHolidays(): array
    {
        return [
            '01/01',
            function ($year) { // Pâques
                $days = easter_days($year) + 1;
                $date = new \DateTime($year.'-03-21 +'.$days.' days');

                return $date->format('d/m');
            },
            '01/05',
            '08/05',
            function ($year) { // Ascension
                $days = easter_days($year) + 39;
                $date = new \DateTime($year.'-03-21 +'.$days.' days');

                return $date->format('d/m');
            },
            function ($year) { // Pentecôte
                $days = easter_days($year) + 49;
                $date = new \DateTime($year.'-03-21 +'.$days.' days');

                return $date->format('d/m');
            },
            '14/07',
            '15/08',
            '01/11',
            '11/11',
            '25/12'
        ];
    }

    /**
     * To know if today is holiday.
     *
     * @return bool
     */
    public function isHoliday(): bool
    {
        $holidays = $this->getHolidays();
        $today = $this->date->format('d/m');

        foreach ($holidays as $holiday) {
            if (is_callable($holiday)) {
                $holiday = call_user_func($holiday, $this->date->format('Y'));
            }

            if ($today === $holiday) {
                return true;
            }
        }

        return false;
    }
}
