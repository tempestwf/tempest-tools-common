<?php
/**
 * Created by PhpStorm.
 * User: Will
 * Date: 9/27/2017
 * Time: 3:34 PM
 */

namespace TempestTools\Common\Laravel\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use TempestTools\Common\ArrayObject\DefaultTTArrayObject;
use TempestTools\Common\Contracts\ArrayHelperContract;
use TempestTools\Common\Contracts\HasArrayHelperContract;
use TempestTools\Common\Contracts\HasUserContract;
use TempestTools\Common\Exceptions\Laravel\Http\Middleware\CommonMiddlewareException;
use TempestTools\Common\Helper\ArrayHelper;
use TempestTools\Common\Laravel\Utility\Extractor;


class BasicDataExtractorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \RuntimeException
     */
    public function handle(Request $request, Closure $next)
    {
        $controller = $request->route()->getController();
        $actions = $request->route()->getAction();
        $clearExistingArrayHelper = $actions['clearExistingArrayHelper'] ?? true;

        if ($controller instanceof HasArrayHelperContract === false) {
            throw CommonMiddlewareException::controllerDoesNotImplement('HasArrayHelperContract');
        }

        $arrayHelper =  $clearExistingArrayHelper === true?null:$controller->getArrayHelper();
        $arrayHelper = $arrayHelper ?? new ArrayHelper(new DefaultTTArrayObject());

        $this->extractPrimary($request, $arrayHelper, $controller);
        $this->extractAdditional($request, $arrayHelper, $controller);

        $controller->setArrayHelper($arrayHelper);

        return $next($request);
    }

    /**
     * @param Request $request
     * @param ArrayHelperContract $arrayHelper
     * @param HasArrayHelperContract $controller
     * @throws \TempestTools\Common\Exceptions\Helper\ArrayHelperException
     */
    protected function extractPrimary (Request $request, ArrayHelperContract $arrayHelper, HasArrayHelperContract $controller):void
    {
        $laravelExtractor = new Extractor($request);

        $extractList = [$laravelExtractor];
        if ($controller instanceof HasUserContract) {
            $user = $controller->getUser();
            $extractList[] = $user;
        } else {
            $user = null;
        }

        $arrayHelper->extract($extractList);
    }

    /**
     * @param Request $request
     * @param ArrayHelperContract $arrayHelper
     * @param HasArrayHelperContract $controller
     * @throws \RuntimeException
     */
    protected function extractAdditional (Request $request, ArrayHelperContract $arrayHelper, HasArrayHelperContract $controller):void
    {
        $actions = $request->route()->getAction();
        if (isset($actions['additionalExtractors']) === true && is_array($actions['additionalExtractors']) === true ) {
            $extractList = [];
            $extra = ['self'=>$this, 'controller'=>$controller, 'arrayHelper'=>$arrayHelper];
            /** @var array $additionalExtractors */
            $additionalExtractors = $actions['additionalExtractors'];
            foreach($additionalExtractors as $extractor) {
                $extractList[] = $arrayHelper->parse($extractor, $extra);
            }
            $arrayHelper->extract($extractList);
        }

    }
}