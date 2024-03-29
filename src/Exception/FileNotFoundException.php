<?php
/**
 * Created by PhpStorm.
 * Author: mickael-dev
 * File: FileNotFoundException.php
 * Created: 07/12/2019 18:26
 */

declare(strict_types=1);

namespace ComposerLockParser\Exception;

use Throwable;

/**
 * Class FileNotFoundException
 *
 * @package ComposerLockParser\Exception
 */
class FileNotFoundException extends \LogicException
{
    protected $message = 'Sorry! This file was not found or does not exist';

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($this->message, $code, $previous);
    }
}
