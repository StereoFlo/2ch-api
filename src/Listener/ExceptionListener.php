<?php

declare(strict_types = 1);

namespace App\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use function in_array;

class ExceptionListener implements EventSubscriberInterface
{
    public const DEBUG_ENVIRONMENTS = ['dev'];

    /**
     * @var string
     */
    private $environment;

    public function __construct(string $environment)
    {
        $this->environment = $environment;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        if (!$this->isDebug($event)) {
            return;
        }
        $e = $event->getThrowable();

        $event->setResponse(JsonResponse::create([
            'error' => $e->getMessage(),
        ], 500));
    }

    private function isDebug(ExceptionEvent $event): bool
    {
        return !in_array($this->environment, self::DEBUG_ENVIRONMENTS, true) || !$event->getRequest()->get('debug');
    }
}
