<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    // Pengaturan Email Pengirim
    public string $fromEmail = 'dimasw694@student.ub.ac.id'; // Ganti dengan alamat email Anda
    public string $fromName  = 'Admin Kerjasama';
    public string $subject   = 'Balasan Pengaduan Anda';
    public string $subject2   = 'Account for Login';

    /**
     * The "user agent"
     */
    public string $userAgent = 'CodeIgniter';

    /**
     * The mail sending protocol: mail, sendmail, smtp
     */
    public string $protocol = 'smtp'; // Gunakan SMTP untuk mengirim email

    /**
     * SMTP Server Hostname
     */
    public string $SMTPHost = 'smtp.gmail.com'; // Ganti dengan host SMTP Anda

    /**
     * SMTP Username
     */
    public string $SMTPUser = 'dimasw694@student.ub.ac.id'; // Ganti dengan email SMTP Anda

    /**
     * SMTP Password
     */
    public string $SMTPPass = 'golm jkov gvsn tmfn'; // Ganti dengan password email SMTP Anda

    /**
     * SMTP Port
     */
    public int $SMTPPort = 587; // Port SMTP

    /**
     * SMTP Encryption
     */
    public string $SMTPCrypto = 'tls'; // Gunakan 'tls' atau 'ssl' sesuai dengan pengaturan server SMTP

    /**
     * SMTP Timeout (in seconds)
     */
    public int $SMTPTimeout = 120; // Waktu timeout SMTP

    /**
     * SMTP Debugging Level
     * 0 = Disable Debugging
     * 1 = Display Errors
     * 2 = Display Debugging Info
     */
    public int $SMTPDebug = 2; // Debugging level

    /**
     * Enable word-wrap
     */
    public bool $wordWrap = true;

    /**
     * Character count to wrap at
     */
    public int $wrapChars = 76;

    /**
     * Type of mail, either 'text' or 'html'
     */
    public string $mailType = 'html'; // Kirim email dalam format HTML

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     */
    public string $charset = 'UTF-8';

    /**
     * Whether to validate the email address
     */
    public bool $validate = true;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     */
    public int $priority = 3;

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $CRLF = "\r\n";

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $newline = "\r\n";

    /**
     * Enable BCC Batch Mode.
     */
    public bool $BCCBatchMode = false;

    /**
     * Number of emails in each BCC batch
     */
    public int $BCCBatchSize = 200;

    /**
     * Enable notify message from server
     */
    public bool $DSN = false;
}
