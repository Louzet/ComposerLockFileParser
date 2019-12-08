<?php
/**
 * Created by PhpStorm.
 * Author: mickael-dev
 * File: InvalidComposerLockFileException.php
 * Created: 07/12/2019 18:26
 */

declare(strict_types=1);

namespace ComposerLockParser\Exception;

use Throwable;

/**
 * Class InvalidComposerLockFileException
 *
 * @package ComposerLockParser\Exception
 */
class InvalidComposerLockFileException extends \LogicException
{
    protected $message = 'Sorry! It looks like this file is not a composer.lock file';

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($this->message, $code, $previous);
    }
}
