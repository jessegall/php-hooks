<?php

if (! function_exists('resolve_traits')) {
    function resolve_traits(string $class): array
    {
        $traits = [];

        do {
            $traits = array_merge(class_uses($class), $traits);
        } while ($class = get_parent_class($class));

        $search = $traits;

        while (! empty($search)) {
            $new = class_uses(array_pop($search));

            $traits = array_merge($new, $traits);

            $search = array_merge($new, $search);
        };

        foreach ($traits as $trait => $same) {
            $traits = array_merge(class_uses($trait), $traits);
        }

        return array_unique($traits);
    }
}

if (! function_exists('base_class')) {
    function base_class(string $class): string
    {
        return array_reverse(explode('\\', $class))[0];
    }
}