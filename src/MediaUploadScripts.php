<?php

declare(strict_types=1);

namespace Gebruederheitz\Wordpress\MetaFields;

use Gebruederheitz\SimpleSingleton\Singleton;

class MediaUploadScripts extends Singleton
{
    private const SCRIPT_HANDLE = 'wp-meta-forms-media-upload';

    private $hasBeenEnqueued = false;

    public static function registerScripts(): void
    {
        wp_register_script(
            self::SCRIPT_HANDLE,
            __DIR__ . '/../js/dist/media-upload.js',
            [],
        );
    }

    public static function enqueueScripts(): void
    {
        /** @var MediaUploadScripts $instance */
        $instance = self::getInstance();

        if (!$instance->hasBeenEnqueued) {
            $instance->enqueue();
        }
    }

    private function enqueue(): void
    {
        $this->hasBeenEnqueued = true;
        wp_enqueue_script(self::SCRIPT_HANDLE);
    }
}
