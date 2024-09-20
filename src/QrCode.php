<?php

namespace Deller\QrCode;

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\EyeFill;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer;

abstract class QrCode
{
    protected $errorCorrectionLevel;
    protected $size = 300;
    protected $color = [0, 0, 0]; // Default to black
    protected $backgroundColor = [255, 255, 255]; // Default to white
    protected $margin = 10;
    protected $topLeftEyeColor = [0, 0, 0];
    protected $topRightEyeColor = [0, 0, 0];
    protected $bottomLeftEyeColor = [0, 0, 0];

    public function __construct()
    {
        $this->errorCorrectionLevel = ErrorCorrectionLevel::M(); // Default to medium
    }

    public function setSize(int $size)
    {
        $this->size = $size;
        return $this;
    }

    public function setColor(array $color)
    {
        $this->color = $color;
        return $this;
    }

    public function setBackgroundColor(array $backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    public function setMargin(int $margin)
    {
        $this->margin = $margin;
        return $this;
    }

    public function setErrorCorrectionLevel(string $level)
    {
        switch (strtoupper($level)) {
            case 'L':
                $this->errorCorrectionLevel = ErrorCorrectionLevel::L();
                break;
            case 'M':
                $this->errorCorrectionLevel = ErrorCorrectionLevel::M();
                break;
            case 'Q':
                $this->errorCorrectionLevel = ErrorCorrectionLevel::Q();
                break;
            case 'H':
                $this->errorCorrectionLevel = ErrorCorrectionLevel::H();
                break;
            default:
                throw new \InvalidArgumentException("Invalid error correction level: $level");
        }
        return $this;
    }

    public function setTopLeftEyeColor(array $color)
    {
        $this->topLeftEyeColor = $color;
        return $this;
    }

    public function setTopRightEyeColor(array $color)
    {
        $this->topRightEyeColor = $color;
        return $this;
    }

    public function setBottomLeftEyeColor(array $color)
    {
        $this->bottomLeftEyeColor = $color;
        return $this;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getColor(): array
    {
        return $this->color;
    }

    public function getMargin(): int
    {
        return $this->margin;
    }

    public function getBackgroundColor(): array
    {
        return $this->backgroundColor;
    }

    public function getErrorCorrectionLevel(): ErrorCorrectionLevel
    {
        return $this->errorCorrectionLevel;
    }

    public function getTopLeftEyeColor(): array
    {
        return $this->topLeftEyeColor;
    }

    public function getTopRightEyeColor(): array
    {
        return $this->topRightEyeColor;
    }

    public function getBottomLeftEyeColor(): array
    {
        return $this->bottomLeftEyeColor;
    }

    abstract public function getData(): string;

    public function generate(): string
    {
        // Create the eye fills for the three QR code corners
        $topLeftEyeFill = EyeFill::uniform(new Rgb(...$this->topLeftEyeColor));
        $topRightEyeFill = EyeFill::uniform(new Rgb(...$this->topRightEyeColor));
        $bottomLeftEyeFill = EyeFill::uniform(new Rgb(...$this->bottomLeftEyeColor));

        // Create the fill object for the foreground and background colors
        $fill = Fill::withForegroundColor(
            new Rgb(...$this->backgroundColor),  // Background color
            new Rgb(...$this->color),            // Foreground color
            $topLeftEyeFill,                     // Top-left eye fill
            $topRightEyeFill,                    // Top-right eye fill
            $bottomLeftEyeFill                   // Bottom-left eye fill
        );

        // Create the RendererStyle object with proper parameters
        $style = new RendererStyle(
            $this->size,        // Module size
            $this->margin,      // Margin
            null,               // No custom module style
            null,               // No custom eye design (only using eye colors)
            $fill               // Pass the custom fill object
        );

        // Create the ImageRenderer with the Imagick backend
        $renderer = new ImageRenderer(
            $style,
            new \BaconQrCode\Renderer\Image\ImagickImageBackEnd()
        );

        // Create the Writer with the renderer
        $writer = new Writer($renderer);

        // Generate the QR code with the data provided
        return $writer->writeString($this->getData());
    }

}
