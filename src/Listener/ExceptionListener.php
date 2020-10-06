<?php

declare(strict_types = 1);

namespace App\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use function in_array;

final class ExceptionListener implements EventSubscriberInterface
{
    public const DEBUG_ENVIRONMENTS = ['dev'];

    private string $environment;

    public function __construct(string $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return string[]
     */
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

        $event->setResponse(new JsonResponse([
            'error' => $e->getMessage(),
        ], 500));
    }

    private function isDebug(ExceptionEvent $event): bool
    {
        return !in_array($this->environment, self::DEBUG_ENVIRONMENTS, true) || !$event->getRequest()->get('debug');
    }
}
