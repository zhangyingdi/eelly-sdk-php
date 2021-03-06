<?php

declare(strict_types=1);

/*
 * This file is part of eelly package.
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eelly\SDK;

use Eelly\OAuth2\Client\Provider\EellyProvider;
use GuzzleHttp\Psr7\MultipartStream;
use League\OAuth2\Client\Token\AccessToken;
use LogicException;
use Phalcon\Di;
use Psr\Http\Message\UploadedFileInterface;

class EellyClient
{
    /**
     * @var string
     */
    public static $traceId;

    /**
     * 服务提供者默认地址
     *
     * @var array
     */
    private static $providerUri = [
        'logger'  => 'https://api.eelly.com',
        'example' => 'https://api.eelly.com',
        'oauth'   => 'https://api.eelly.com',
        'user'    => 'https://api.eelly.com',
        'store'   => 'https://api.eelly.com',
        'pay'     => 'https://api.eelly.com',
        'service' => 'https://api.eelly.com',
    ];

    private static $services = [];

    /**
     * @var EellyProvider
     */
    private $provider;

    /**
     * @var EellyClient
     */
    private static $self;

    /**
     * @var \League\OAuth2\Client\Token\AccessToken
     */
    private static $accessToken;

    /**
     * EellyClient constructor.
     *
     * @param array $options
     * @param array $collaborators
     * @param array $providerUri
     */
    final private function __construct(array $options, array $collaborators = [], array $providerUri = [])
    {
        self::$providerUri = $providerUri + self::$providerUri;
        $this->provider = new EellyProvider($options, $collaborators);
    }

    /**
     * @param array $options
     * @param array $collaborators
     * @param array $providerUri
     *
     * @return self
     */
    public static function init(array $options, array $collaborators = [], array $providerUri = []): self
    {
        if (null === self::$self) {
            self::$self = new self($options, $collaborators, $providerUri);
        }

        return self::$self;
    }

    /**
     * @return \Eelly\OAuth2\Client\Provider\EellyProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $traceId
     */
    public function setTraceId(string $traceId): void
    {
        self::$traceId = $traceId;
    }

    /**
     * @param mixed $grant
     *
     * @return \League\OAuth2\Client\Token\AccessToken
     */
    public function getAccessToken($grant, array $options = [])
    {
        return $this->provider->getAccessToken($grant, $options);
    }

    /**
     * @param AccessToken $accessToken
     *
     * @return AccessToken
     */
    public function setAccessToken(AccessToken $accessToken)
    {
        return self::$accessToken = $accessToken;
    }

    /**
     * @param string $uri
     * @param string $method
     * @param mixed  ...$args
     *
     * @return mixed
     */
    public static function request(string $uri, string $method, ...$args)
    {
        if (null === self::$self) {
            $di = Di::getDefault();
            if ($di->has('eellyClient')) {
                $di->getShared('eellyClient');
            } else {
                throw new \ErrorException('eelly client initial fail');
            }
        }
        $client = self::$self;
        $accessToken = self::$accessToken;
        if (null === $accessToken) {
            $accessToken = $client->getAccessToken('client_credentials');
        }
        list($serviceName) = explode('/', $uri);
        $uri = self::$providerUri[$serviceName].'/'.$uri.'/'.$method;
        $stream = new MultipartStream($client->paramsToMultipart($args));
        $provider = $client->getProvider();
        $options = [
            'body' => $stream,
        ];
        if (!empty(self::$traceId)) {
            $options['headers'] = [
                'traceId' => self::$traceId,
            ];
        }
        $request = $provider->getAuthenticatedRequest(EellyProvider::METHOD_POST, $uri, $accessToken->getToken(), $options);
        $response = $provider->getResponse($request);
        $class = $response->getHeader('ReturnType');
        if (!empty($class)) {
            $returnType = $class[0];
            if (class_exists($returnType)) {
                $array = json_decode((string) $response->getBody(), true);
                if (is_subclass_of($returnType, LogicException::class)) {
                    throw new $returnType($array['error'], $array['context']);
                } else {
                    $object = $returnType::hydractor($array['data']);
                }
            } else {
                $object = json_decode((string) $response->getBody(), true);
                $object = $object['data'];
                settype($object, $returnType);
            }
        } else {
            $object = (string) $response->getBody();
        }

        return $object;
    }

    protected function paramsToMultipart($params, $prefix = null)
    {
        $multipart = [];
        foreach ($params as $key => $value) {
            $p = null == $prefix ? $key : $prefix.'['.$key.']';
            if ($value instanceof UploadedFileInterface) {
                $multipart[] = [
                    'name'     => $p,
                    'contents' => $value->getStream(),
                ];
            } elseif (is_array($value)) {
                $parentMultipart = $this->paramsToMultipart($value, $p);
                foreach ($parentMultipart as $part) {
                    $multipart[] = $part;
                }
            } elseif (null !== $value) {
                $multipart[] = [
                    'name'     => $p,
                    'contents' => $value,
                ];
            }
        }

        return $multipart;
    }
}
