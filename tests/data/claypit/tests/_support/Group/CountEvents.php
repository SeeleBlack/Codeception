<?php
namespace Group;

use \Codeception\Event\TestEvent;

/**
 * Group class is Codeception Extension which is allowed to handle to all internal events.
 * This class itself can be used to listen events for test execution of one particular group.
 * It may be especially useful to create fixtures data, prepare server, etc.
 *
 * INSTALLATION:
 *
 * To use this group extension, include it to "extensions" option of global Codeception config.
 */
class CountEvents extends \Codeception\GroupObject
{
    /** @var string */
    public static $group = 'countevents';

    public static int $beforeCount = 0;

    public static int $afterCount = 0;

    public function _before(TestEvent $event)
    {
        ++$this::$beforeCount;
        $this->writeln("Group Before Events: " . $this::$beforeCount);
    }

    public function _after(TestEvent $event)
    {
        ++$this::$afterCount;
        $this->writeln("Group After Events: " . $this::$afterCount);
    }
}
