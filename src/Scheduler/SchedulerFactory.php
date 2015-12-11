<?php
namespace Tictock\Scheduler;

use Tictock\Scheduler\Platform\Windows;
use Tictock\Scheduler\Platform\Nix;
use InvalidArgumentException;

/**
 * A factor for creating a Scheduler
 */
class SchedulerFactory
{
    /**
     * Create an instance of Tictock\Scheduler\SchedulerInterface
     * @param string $platform The platform, null to auto-detect
     * @return Windows|Nix
     * @throws InvalidArgumentException When the platform is not recognized
     */
    public function create($platform = null)
    {
        if (null === $platform) {
            $platform = $this->getPlatform();
        }

        switch ($platform) {
            case 'windows':
                return new Windows();
            case 'linux':
            case 'unix':
            case 'nix':
                return new Nix();
        }

        throw new InvalidArgumentException(
            sprintf('Unknown platform: %s', $platform)
        );
    }

    /**
     * Fetch the OS platform
     *
     * @return string The auto-detected platform
     */
    protected function getPlatform()
    {
        return substr(PHP_OS, 0, 3) === 'WIN'
            ? 'windows'
            : 'nix';
    }
}
