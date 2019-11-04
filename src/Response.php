<?php

namespace Mediadevs\ResponseHandler;

class Response
{
    /**
     * Constants for response levels. Order: LOW -> HIGH
     */
    const DEFAULT       = 0;
    const INFO          = 1;
    const SUCCESS       = 2;
    const WARNING       = 3;
    const ERROR         = 4;

    /**
     * Uses bootstrap class names to define alert type
     * @var array
     */
    private $levels = array(
        self::DEFAULT   => 'Default',
        self::INFO      => 'Information',
        self::SUCCESS   => 'Success',
        self::WARNING   => 'Warning',
        self::ERROR     => 'Error',
    );

    /**
     * Delimiters for wrapping the variables
     * @var array
     */
    private $delimiters = array(0 => '', 1 => '');

    /**
     * Responses will be stored in here
     * @var array
     */
    private $responses = array();

    /**
     * Handling response messages and stores them inside $this->responses.
     * @param string      $message
     * @param array       $parameters
     * @param int         $level
     *
     * @return Response
     */
    public function add(
        string  $message,
        array   $parameters = array(),
        int     $level      = self::DEFAULT
    ): self
    {
        foreach ($parameters as $key => $value) {
            // Wrapping the delimiters around the value
            $value = $this->delimiters[0] . $value . $this->delimiters[1];

            // Replacing the placeholders in the message with the parameters
            $message = str_replace('{%' . $key . '%}', $value, $message);
        }

        // Adding this response to the response array
        $this->responses[] = [
            'level'     => $this->levels[$level],
            'message'   => $message
        ];

        return $this;
    }

    /**
     * @param string      $left
     * @param string|null $right
     *
     * @return Response
     */
    public function delimiters(string $left, string $right = null) : self
    {
        // Checking whether the highlighting is enabled, else clearing the values.
        $this->delimiters[0] = $left;
        $this->delimiters[1] = $right ?? $left;

       return $this;
    }

    /**
     * Changing the label for the defined level
     * @param int    $level
     * @param string $label
     *
     * @return Response
     */
    public function changeLabelForLevel(int $level, string $label) : self
    {
        if (array_key_exists($level, $this->levels)) {
            $this->levels[$level] = $label;
        }

        return $this;
    }

    /**
     * Returns the error messages as JSON.
     * @return string
     */
    public function toJSON() : string
    {
        return json_encode($this->responses, JSON_PRETTY_PRINT);
    }

    /**
     * Returns the error messages as an Array.
     * @return array
     */
    public function toArray() : array
    {
        return $this->responses;
    }
}