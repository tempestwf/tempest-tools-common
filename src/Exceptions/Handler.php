<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 7/12/2017
 * Time: 6:50 PM
 */

namespace TempestTools\Common\Exceptions;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use TempestTools\Common\Contracts\Annotated;
use TempestTools\Common\Contracts\Localized;


class Handler extends ExceptionHandler
{
    /** @noinspection ClassOverridesFieldOfSuperClassInspection */
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     * @throws Exception
     */
    public function report(Exception $e)
    {
        $e = $this->formatException($e);
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $e = $this->formatException($e);
        return parent::render($request, $e);
    }

    /**
     * Will return a TransformedForUserException if it detects the interfaces that trigger transformations on the exception
     * @param Exception $e
     * @return Exception
     */
    protected function formatException(Exception $e): \Exception
    {
        if ($e instanceof Annotated || $e instanceof Localized) {
            $message = $e->getMessage();
            $message = $e instanceof Localized && $e->isLocalize() === true?_($message):$message;
            $message = $e instanceof Annotated?$message . ' ' . $e->annotationsToString() :$message;
            $e = new TransformedForUserException($message, $e->getCode(), $e);
        }

        return $e;
    }
}