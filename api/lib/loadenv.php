<?php
namespace App\Lib;

class LoadEnv
{
    protected $path;

    public function __construct(string $path)
    {
        if ( ! file_exists($path) ) {
            throw new InvalidArgumentException( "{$path} does not exist!" );
        }
        
        $this->path = $path;
    }

    public function init() :void
    {
        if ( ! is_readable($this->path) ) {
            throw new \RuntimeException( "{$this->path} file is not readable." );
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ( $lines as $line ) {

            if ( strpos(trim($line), '#') ) {
                continue;
            }

            list($variable, $value) = explode('=', $line, 2);
            $variables  = trim($variable);
            $value      = trim($value);

            if ( 
                ! array_key_exists($variable, $_SERVER) 
                && ! array_key_exists($value, $_ENV)
            ) {
                putenv(sprintf('%s=%s', $variable, $value));
                $_ENV[$variables]       = $value;
                $_SERVER[$variables]    = $value;
            }
        }
    }
}