<?php

namespace TempestTools\Common\Laravel;

use App;
use Config;
use Illuminate\Http\Request;
use TempestTools\Common\Utility\ExtractorAbstract;


class Extractor extends ExtractorAbstract
{
    /**
     * @var array $options
     */
    protected $extractorOptions = [
        'request'=>[
            'enabled'=>true,
            'all'=>false
        ],
        'route'=>[
            'enabled'=>true
        ],
        'config'=>[
            'enabled'=>true
        ],
        'environment'=>[
            'enabled'=>true
        ]
    ];


    /**
     * @var Request $request
     */
    protected $request;

    /**
     * Extractor constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->setRequest($request);

    }

    /**
     * Returns values array with a top level key. Used to get data that will be stored on a array helper array.
     *
     * @return array
     * @throws \UnexpectedValueException
     * @throws \LogicException
     */
    public function extractValues() : array
    {
        $request = $this->getRequest();
        $options = $this->getExtractorOptions();
        $requestValues = [];
        if ($options['request']['enabled'] === true) {
            $requestValues['requestParams'] = $request->all();


            $requestValues['eTags'] = $request->getETags();
            $requestValues['defaultLocale'] = $request->getDefaultLocale();
            $requestValues['contentType'] = $request->getContentType();
            $requestValues['content'] = $request->getContent();
            $requestValues['clientIp'] = $request->getClientIp();
            $requestValues['clientIps'] = $request->getClientIps();
            $requestValues['basePath'] = $request->getBasePath();
            $requestValues['baseUrl'] = $request->getBaseUrl();
            $requestValues['method'] = $request->getMethod();
            $requestValues['uri'] = $request->getUri();
            $requestValues['requestUri'] = $request->getRequestUri();
            $requestValues['requestFormat'] = $request->getRequestFormat();
            $requestValues['host'] = $request->getHost();
            $requestValues['httpHost'] = $request->getHttpHost();
            $requestValues['schemeAndHttpHost'] = $request->getSchemeAndHttpHost();
            $requestValues['local'] = $request->getLocale();
            $requestValues['pathInfo'] = $request->getPathInfo();
            $requestValues['port'] = $request->getPort();
            $requestValues['password'] = $request->getPassword();
            $requestValues['preferredLanguage'] = $request->getPreferredLanguage();
            $requestValues['queryString'] = $request->getQueryString();
            $requestValues['scriptName'] = $request->getScriptName();
            $requestValues['user'] = $request->getUser();
            $requestValues['userInfo'] = $request->getUserInfo();
            $requestValues['root'] = $request->root();
            $requestValues['url'] = $request->url();
            $requestValues['fullUrl'] = $request->fullUrl();
            $requestValues['decodePath'] = $request->decodedPath();
            $requestValues['ajax'] = $request->ajax();
            $requestValues['pjax'] = $request->pjax();
            $requestValues['secure'] = $request->secure();
            $requestValues['isJson'] = $request->isJson();
            $requestValues['expectsJson'] = $request->expectsJson();
            $requestValues['wantsJson'] = $request->wantsJson();
            $requestValues['acceptsJson'] = $request->acceptsJson();
            $requestValues['acceptsHtml'] = $request->acceptsHtml();
            $requestValues['bearerToken'] = $request->bearerToken();
            $requestValues['fingerPrint'] =  $request->fingerprint();
            
            if ($options['request']['all'] === true) {
                $requestValues['encodings'] = $request->getEncodings();
                $requestValues['charsets'] = $request->getCharsets();
                $requestValues['userResolver'] = $request->getUserResolver();
                $requestValues['realMethod'] = $request->getRealMethod();
                $requestValues['languages'] = $request->getLanguages();
                $requestValues['routeResolver'] = $request->getRouteResolver();
                $requestValues['session'] = $request->getSession();
                $requestValues['acceptableContentTypes'] = $request->getAcceptableContentTypes();

            }
        }

        $routeValues = [];
        if ($options['route']['enabled'] === true) {
            $routeValues['actions'] = $request->route()->getAction();
            $routeValues['uri'] = $request->route()->getUri();
            $routeValues['path'] = $request->route()->getPath();
            $routeValues['isProtected'] = $request->route()->isProtected();
            $routeValues['hasThrottle'] = $request->route()->hasThrottle();
            $routeValues['scopes'] = $request->route()->getScopes();
            $routeValues['scopeStrict'] = $request->route()->scopeStrict();
            $routeValues['rateLimit'] = $request->route()->rateLimit();
            $routeValues['rateLimitExpiration'] = $request->route()->rateLimitExpiration();
            $routeValues['name'] = $request->route()->getName();
            $routeValues['requestIsConditional'] = $request->route()->requestIsConditional();
            $routeValues['action'] = $request->route()->getAction();
            $routeValues['actionName'] = $request->route()->getActionName();
            $routeValues['versions'] = $request->route()->getVersions();
            $routeValues['methods'] = $request->route()->getMethods();
            $routeValues['httpOnly'] = $request->route()->httpOnly();
            $routeValues['httpsOnly'] = $request->route()->httpsOnly();
            $routeValues['secure'] = $request->route()->secure();
            $routeValues['domain'] = $request->route()->domain();
        }
        $config = [];
        if ($options['config']['enabled'] === true) {
            $config = Config::all();
        }

        $environment = NULL;
        if ($options['config']['environment'] === true) {
            $environment = App::environment();
        }

        return [
            'framework'=>[
                'request'=>$requestValues,
                'route'=>$routeValues,
                'config'=>$config,
                'environment'=>$environment
            ]
        ];
    }

    /**
     * @param Request $request
     * @return Extractor
     */
    public function setRequest(Request $request):Extractor
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest() : Request
    {
        return $this->request;
    }

}
