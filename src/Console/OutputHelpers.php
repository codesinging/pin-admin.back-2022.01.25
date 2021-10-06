<?php

namespace CodeSinging\PinAdmin\Console;

trait OutputHelpers
{
    /**
     * Output a lead message.
     * @param string $title
     * @param string $prefix
     */
    protected function title(string $title, string $prefix = '- ')
    {
        $this->line($prefix . $title);
    }
}