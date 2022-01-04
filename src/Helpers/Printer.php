<?php

namespace Src\Helpers;

/**
 * Pretty printer
 *
 * @package Src\Helpers
 * @author  Thiago  <thiagom.devsec@gmail.com>
 * @version 1.0
 */
class Printer
{
    /**
     * Display message
     *
     * @param  string $message
     * @return void
     */
    private function out(string $message): void
    {
        echo $message;
    }

    /**
     * @return void
     */
    private function newLine(): void
    {
        $this->out(PHP_EOL);
    }

    /**
     * Mount display
     *
     * @param  string $message
     * @return void
     */
    public function display(string $message): void
    {
        $this->newLine();
        $this->out($message);
        $this->newLine();
    }
}
