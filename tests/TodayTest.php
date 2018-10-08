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
}
