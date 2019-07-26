<?php

namespace TempestTools\Common\Laravel\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Tymon\JWTAuth\Middleware\BaseMiddleware;
/**
 * LocalizationMiddleware sets the locale with respect to the user's locale
 *
 * @link    https://github.com/tempestwf
 * @author  Jerome Erazo <https://github.com/jerazo>
 */
class ReCaptcha extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (env('GOOGLE_RECAPTCHA_SECRET')) {
            $options = $request->input('options');
            if($options) {
                if (array_key_exists('g-recaptcha-response-omit', $options)) {
                    if ($options['g-recaptcha-response-omit'] === env('GOOGLE_RECAPTCHA_SKIP_CODE')) {
                        return $next($request);
                    }
                }
                if (array_key_exists('g-recaptcha-response', $options)) {
                    $client = new Client();
                    $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
                        ['form_params'=>
                            [
                                'secret'=>env('GOOGLE_RECAPTCHA_SECRET'),
                                'response'=>$options['g-recaptcha-response']
                            ]
                        ]
                    );
                    $body = json_decode((string)$response->getBody());
                    if ($body->success) {
                        return $next($request);
                    } else {
                        return $this->respond('tempesttools.recaptcha.invalid', 'tempesttools_recaptcha_invalid', 400);
                    }
                } else {
                    return $this->respond('tempesttools.recaptcha.absent', 'tempesttools_recaptcha_no_value', 400);
                }
            }

            return $this->respond('tempesttools.recaptcha.absent', 'tempesttools_recaptcha_no_parameters', 400);
        } else {
            return $next($request);
        }
    }
}