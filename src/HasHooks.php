<?php

namespace JesseGall\Hooks;

use Closure;

trait HasHooks
{

    /**
     * @var Closure[]
     */
    private array $hooks;

    /**
     * Initialize hooks.
     *
     * @return void
     */
    public function initializeHooks(): void
    {
        $hooks = $this->resolveHooks();

        foreach ($hooks as $hook) {
            $hook();
        }
    }

    /**
     * Resolve the available hooks.
     *
     * @return array
     */
    public function resolveHooks(): array
    {
        if (isset($this->hooks)) {
            return $this->hooks;
        }

        $hooks = [];

        $traits = resolve_traits(get_class($this));

        foreach ($traits as $trait) {
            if (method_exists($trait, $this->getHookMethod($trait))) {
                $hooks[] = function () use ($trait) {
                    $this->{$this->getHookMethod($trait)}();
                };
            }
        }

        return $this->hooks = $hooks;
    }

    /**
     * Returns the hook method name for the given trait.
     *
     * @param string $trait
     * @return string
     */
    protected function getHookMethod(string $trait): string
    {
        return self::getHookPrefix() . base_class($trait);
    }

    /**
     * Returns the prefix for the hook methods.
     *
     * @return string
     */
    protected function getHookPrefix(): string
    {
        return $this->hookPrefix ?? 'hook';
    }

}