# Tictock

[![Build Status](https://travis-ci.org/phillipsdata/tictock.svg?branch=master)](https://travis-ci.org/phillipsdata/tictock)

An OS independent task scheduler.

Provides a fluent interface for scheduling commands to run at various intervals. Works on *nix and Windows.

## Basic Usage

Initialize Tictock with your command:

```php
use Tictock\Tictock;

$cmd = 'the command you want to run';
$tictock = new Tictock($cmd);
```

Schedule your command:

```php
$schedule = $tictock->schedule()
    ->every()
    ->minute()
    ->every()
    ->hour()
    ->every()
    ->dayOfTheMonth()
    ->every()
    ->month()
    ->every()
    ->dayOfTheWeek();
$tictock->save($schedule);
```

The above would schedule your command to execute every minute of every hour of every day. This is the default schedule. We could actually simplify this as:

```php
$schedule = $tictock->schedule();
$tictock->save($schedule);
```

What if we only want to execute on Fridays at 1 AM?

```php
$schedule = $tictock->schedule()
    ->only()
    ->daysOfTheWeek(array(5)) // 0 = Sun, 1 = Mon, ... 5 = Fri, 6 = Sat
    ->only()
    ->hours(array(1)); // 0 = 12 AM, 1 = 1 AM, ... 12 = 12 PM, ... 23 = 11 PM
$tictock->save($schedule);
```

Notice how we don't have to declare that we want it to run every month, or every day of the month. The scheduler will automatically run at every interval unless we tell it otherwise.

Suppose we wanted to run something every 5 minutes?

```php
$schedule = $tictock->schedule()
    ->every()
    ->minutes(5);
$tictock->save($schedule);
```
This could also be written as:

```php
$schedule = $tictock->schedule()
    ->only()
    ->minutes(array(0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55));
$tictock->save($schedule);
```
**Note:** Defining select hours or minutes to run is not supported by Windows. The smallest non-interval value supported by Windows is ```daysofTheMonth()```.

### Explanation of Periods

The `every()` method supports the following:

- `minute()` Every minute
- `minutes(int $n)` Every `$n`th minute (2 - 59)
- `hour()` Every hour
- `hours(int $n)` Every `$n`th hour (2 - 23)
- `dayOfTheMonth()` Every day of the month
- `daysOfTheMonth(int $n)` Every `$n`th day of the month (2 - 30)
- `month()` Every month
- `months(int $n)` Every `$n`th month (2 - 11)
- `dayOfTheWeek()` Every day of the week
- `daysOfTheWeek(int $n)` Every `$n`th day of the week

The `only()` method supports the following:

- `minutes(array $minutes)` Only these minutes (0 - 59)
- `hours(array $hours)` Only these hours (0 - 23)
    - `0` = 12 AM, ..., `23` = 11 PM
- `daysOfTheMonth(array $days)` Only these days of the month (1 - 31)
- `months(array $months)` Only these months (1 - 12)
    - `1` = Janurary
    - `2` = February
    - `3` = March
    - `4` = April
    - `5` = May
    - `6` = June
    - `7` = July
    - `8` = August
    - `9` = September
    - `10` = October
    - `11` = November
    - `12` = December
- `daysOfTheWeek(array $days)` Only these days of the week (0 - 6)
    - `0` = Sunday
    - `1` = Monday
    - `2` = Tuesday
    - `3` = Wednesday
    - `4` = Thursday
    - `5` = Friday
    - `6` = Saturday

## Advanced Usage


### Output

The result of the request is returned by ```Tictock::save()```. If you need the actual output returned, you need explicitly declare the scheduler. This can be done using the built-in ```ScheduleFactory``` or by explicitly initializing the Scheduler you want.

```php
use Tictock\Tictock;

$cmd = 'the command you want to run';
$tictock = new Tictock($cmd);

$scheduler = $tictock->scheduler();
$schedule = $tictock->schedule()
$result = $tictock->save($schedule, $scheduler);

print_r($scheduler->output());
```

### Extending Tictock

Tictock is totally modular. Use your own Schedule or Scheduler to do crazy stuff, like create a recurring todo on some remote web service or program your sprinkler system.

```php
class MySchedule implements \Tictock\Schedule\ScheduleInterface
{
    // ...
}
```

```php
class MyScheduler implements \Tictock\Scheduler\SchedulerInterface
{
    // ...
}
```

```php
use Tictock\Tictock;

$data = 'your data';
$tictock = new Tictock($data);

$schedule = new MySchedule();
$scheduler = new MyScheduler();

$tictock->save($schedule, $scheduler);
```
