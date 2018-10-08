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
