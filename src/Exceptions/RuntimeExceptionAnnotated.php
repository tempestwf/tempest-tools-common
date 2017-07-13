<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 7/12/2017
 * Time: 6:48 PM
 */

namespace TempestTools\Common\Exceptions;


use RuntimeException;
use TempestTools\Common\Contracts\Annotated;
use TempestTools\Common\Contracts\Localized;
use TempestTools\Common\Utility\AnnotatedTrait;
use TempestTools\Common\Utility\LocalizedTrait;
use Throwable;

class RuntimeExceptionAnnotated extends RuntimeException implements Annotated, Localized
{
    use AnnotatedTrait, LocalizedTrait;

    public function __construct(string $message = '', int $code = 0, array $annotations=[], Throwable $previous = null) {
        $this->setAnnotations($annotations);
        parent::__construct($message, $code, $previous);
    }

}