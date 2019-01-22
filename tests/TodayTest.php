<?php

/*
 * This file is part of the Today package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MatthieuMota\Component\Today\Tests;

use MatthieuMota\Component\Today\Today;
use PHPUnit\Framework\TestCase;

class TodayTest extends TestCase
{
    public function testTodayInstance()
    {
        $date = new \DateTime();
        $today = new Today();
        $this->assertInstanceOf(Today::class, $today);
        $this->assertInstanceOf(\DateTimeInterface::class, $today->getDate());
        $this->assertSame($date->format('Y-m-d'), $today->getDate()->format('Y-m-d'));

        $date = new \DateTime('1985-10-21');
        $today = new Today($date);
        $this->assertSame($date->format('Y-m-d'), $today->getDate()->format('Y-m-d'));
    }

    public function testTodayHasHolidays()
    {
        $today = new Today();
        $this->assertNotCount(0, $today->getHolidays());
    }

    public function testTodayIsAParticularDay()
    {
        for ($year = 2018; $year <= 2024; $year++) {
            $this->assertTrue((new Today(new \DateTime($year.'-01-01')))->isHoliday());
            $this->assertTrue((new Today(new \DateTime($year.'-05-01')))->isHoliday());
            $this->assertTrue((new Today(new \DateTime($year.'-05-08')))->isHoliday());
            $this->assertTrue((new Today(new \DateTime($year.'-07-14')))->isHoliday());
            $this->assertTrue((new Today(new \DateTime($year.'-08-15')))->isHoliday());
            $this->assertTrue((new Today(new \DateTime($year.'-11-01')))->isHoliday());
            $this->assertTrue((new Today(new \DateTime($year.'-11-11')))->isHoliday());
            $this->assertTrue((new Today(new \DateTime($year.'-12-25')))->isHoliday());
            $this->assertFalse((new Today(new \DateTime($year.'-01-02')))->isHoliday());
        }

        // Pâques
        $this->assertTrue((new Today(new \DateTime('2018-04-02')))->isHoliday());
        $this->assertTrue((new Today(new \DateTime('2019-04-22')))->isHoliday());
        $this->assertTrue((new Today(new \DateTime('2020-04-13')))->isHoliday());

        // Ascension
        $this->assertTrue((new Today(new \DateTime('2018-05-10')))->isHoliday());
        $this->assertTrue((new Today(new \DateTime('2019-05-30')))->isHoliday());
        $this->assertTrue((new Today(new \DateTime('2020-05-21')))->isHoliday());

        // Pentecôte
        $this->assertTrue((new Today(new \DateTime('2018-05-20')))->isHoliday());
        $this->assertTrue((new Today(new \DateTime('2019-06-09')))->isHoliday());
        $this->assertTrue((new Today(new \DateTime('2020-05-31')))->isHoliday());
    }

    public function testTodayIsASeason()
    {
        $today = new Today(new \DateTime('2019-01-22'));
        $this->assertSame('winter', $today->getSeason());

        $today = new Today(new \DateTime('2019-04-22'));
        $this->assertSame('spring', $today->getSeason());

        $today = new Today(new \DateTime('2019-07-22'));
        $this->assertSame('summer', $today->getSeason());

        $today = new Today(new \DateTime('2019-10-22'));
        $this->assertSame('autumn', $today->getSeason());

        $today = new Today();
        $this->assertContains($today->getSeason(), ['winter', 'spring', 'summer', 'autumn']);
    }
}
