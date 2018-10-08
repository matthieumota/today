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
        $this->assertEquals($date->format('Y-m-d'), $today->getDate()->format('Y-m-d'));

        $date = new \DateTime('1985-10-21');
        $today = new Today($date);

        $this->assertEquals($date->format('Y-m-d'), $today->getDate()->format('Y-m-d'));
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
}
