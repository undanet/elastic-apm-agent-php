<?php

namespace ZoiloMora\ElasticAPM\Events\Metadata;

use ZoiloMora\ElasticAPM\Configuration\CoreConfiguration;
use ZoiloMora\ElasticAPM\Events\Common\Cloud;
use ZoiloMora\ElasticAPM\Events\Common\Process;
use ZoiloMora\ElasticAPM\Events\Common\System;
use ZoiloMora\ElasticAPM\Events\Common\Tags;
use ZoiloMora\ElasticAPM\Events\Common\User;

/**
 * Metadata concerning the other objects in the stream.
 */
final class Metadata implements \JsonSerializable
{
    /**
     * @var Service
     */
    private $service;

    /**
     * @var Process|null
     */
    private $process;

    /**
     * @var System|null
     */
    private $system;

    /**
     * Describes the authenticated User for a request.
     *
     * @var User|null
     */
    private $user;

    /**
     * @var Cloud|null
     */
    private $cloud;

    /**
     * @var Tags|null
     */
    private $labels;

    /**
     * @param Service $service
     * @param Process|null $process
     * @param System|null $system
     * @param User|null $user
     * @param Cloud|null $cloud
     * @param Tags|null $labels
     */
    public function __construct(
        Service $service,
        Process $process = null,
        System $system = null,
        User $user = null,
        Cloud $cloud = null,
        Tags $labels = null
    ) {
        $this->service = $service;
        $this->process = $process;
        $this->system = $system;
        $this->user = $user;
        $this->cloud = $cloud;
        $this->labels = $labels;
    }

    /**
     * @return Service
     */
    public function service()
    {
        return $this->service;
    }

    /**
     * @return Process|null
     */
    public function process()
    {
        return $this->process;
    }

    /**
     * @return System|null
     */
    public function system()
    {
        return $this->system;
    }

    /**
     * @return User|null
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @return Cloud|null
     */
    public function cloud()
    {
        return $this->cloud;
    }

    /**
     * @return Tags|null
     */
    public function labels()
    {
        return $this->labels;
    }

    /**
     * @param CoreConfiguration $coreConfiguration
     *
     * @return Metadata
     */
    public static function create(CoreConfiguration $coreConfiguration)
    {
        return new self(
            Service::create($coreConfiguration),
            Process::discover(),
            System::discover()
        );
    }

    /**
     * @return array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return [
            'metadata' => [
                'service' => $this->service,
                'process' => $this->process,
                'system' => $this->system,
                'user' => $this->user,
                'cloud' => $this->cloud,
                'labels' => $this->labels,
            ]
        ];
    }
}
