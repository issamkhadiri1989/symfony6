<?php

declare(strict_types=1);

namespace App\Service;

class FtpClient
{
    public function __construct(
        private AbstractFileManager $phpFileManager,
        private string $mediaDirectory,
    ) {
    }

    //<editor-fold desc="//...">
    /**
     * Upload file to FTP server.
     */
    public function uploadFileToFtp(): void
    {
        $files = $this->phpFileManager->scan($this->mediaDirectory);
        // ...
        /*$this->sendToFtp($files);*/
    }

    private function sendToFtp(array $files): void
    {
        $ftp = \ftp_connect(hostname: 'hostname', port: 123, timeout: 30);
        \ftp_login(ftp: $ftp, username: 'user', password: 'password');

        foreach ($files as $file) {
            $ret = \ftp_nb_put(
                ftp: $ftp,
                remote_filename: '/destination',
                local_filename: $file,
                offset:\FTP_AUTORESUME
            );
        }
        \ftp_close($ftp);
    }
    //</editor-fold>
}
