Today Component
===============

The Today component provides PHP Object Oriented library to know if today is a particular day, business-day, holiday, current season...

## Installation

Today uses Composer.

```
composer require matthieumota/today
```

## Usage

```php
<?php

require __DIR__.'/vendor/autoload.php';

use MatthieuMota\Component\Today\Today;

$today = new Today();
// $today = new Today(new \DateTime('1985-10-21')); // You can back to the past to see if it was an amazing day.

$today->getHolidays(); // Return array with all holidays.
$today->isHoliday(); // True if today is holiday

```

## Notes

This component is work in progress, it's no stable. Also, you should note that only french holidays are hardcoded because not need to support multi zone, but a PR well documented and tested can be merge.
