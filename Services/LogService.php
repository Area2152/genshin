<?php

namespace Services;

class LogService
{
    private string $logDir;
    private string $filePrefix;

    public function __construct(string $logDir, string $filePrefix = 'MIHOYO_')
    {
        $this->logDir    = rtrim($logDir, DIRECTORY_SEPARATOR);
        $this->filePrefix = $filePrefix;

        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0777, true);
        }
    }

    private function getCurrentLogFilePath(): string
    {
        $fileName = sprintf(
            '%s%s_%s.log',
            $this->filePrefix,
            date('m'),
            date('Y')
        );

        return $this->logDir . DIRECTORY_SEPARATOR . $fileName;
    }

    public function write(string $level, string $message): void
    {
        $file = $this->getCurrentLogFilePath();
        $date = date('Y-m-d H:i:s');

        $line = sprintf("[%s] [%s] %s%s", $date, strtoupper($level), $message, PHP_EOL);

        file_put_contents($file, $line, FILE_APPEND);
    }

    public function getLogFiles(): array
    {
        if (!is_dir($this->logDir)) {
            return [];
        }

        $files = glob($this->logDir . DIRECTORY_SEPARATOR . $this->filePrefix . '*.log') ?: [];
        $files = array_map('basename', $files);
        sort($files);

        return $files;
    }

    public function read(string $fileName): ?string
    {
        $path = $this->logDir . DIRECTORY_SEPARATOR . $fileName;

        if (!is_file($path)) {
            return null;
        }

        return file_get_contents($path) ?: '';
    }
}
