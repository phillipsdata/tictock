# tictock


An OS independent task scheduler.

Provides a fluent interface for scheduling commands to run at various intervals. Works on *nix and Windows.

## Basic Usage

Initialize TicTock with your command:

```php
use tictock\TicTock;

$cmd = 'the command you want to run';
$tictock = new TicTock($cmd);
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

The above would schedule your command to execute every minute of every hour of every day. We could actually simplify this as:

```php
$schedule = $tictock->schedule();
$tictock->save($schedule);
```

What if we only want to execute every Friday at 1 AM?

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
    ->only()
    ->minutes(array(0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55));
$tictock->save();
```

An easier way to write this would be:

```php
$schedule = $tictock->schedule()
    ->every()
    ->minutes(5);
$tictock->save($schedule);
```
