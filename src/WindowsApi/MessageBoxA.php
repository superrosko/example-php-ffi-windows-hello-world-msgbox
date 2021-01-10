<?php

declare(strict_types=1);

namespace Superrosko\ExamplePhpFFI\WindowsApi;

use FFI;

/**
 * Class MessageBoxA.
 */
class MessageBoxA
{
    /**
     * uType - Type: UINT
     * To indicate the buttons displayed in the message box, specify one of the following values.
     */
    const MB_ABORTRETRYIGNORE = 0x00000002; // The message box contains three push buttons: Abort, Retry, and Ignore.
    const MB_CANCELTRYCONTINUE = 0x00000006; // The message box contains three push buttons: Cancel, Try Again, Continue.
    const MB_HELP = 0x00004000; // Adds a Help button to the message box. When the user clicks the Help button or presses F1, the system sends a WM_HELP message to the owner.
    const MB_OK = 0x00000000; // The message box contains one push button: OK. This is the default.
    const MB_OKCANCEL = 0x00000001; // The message box contains two push buttons: OK and Cancel.
    const MB_RETRYCANCEL = 0x00000005; // The message box contains two push buttons: Retry and Cancel.
    const MB_YESNO = 0x00000004; // The message box contains two push buttons: Yes and No.
    const MB_YESNOCANCEL = 0x00000003; // The message box contains three push buttons: Yes, No, and Cancel.

    /**
     * uType - Type: UINT
     * To display an icon in the message box, specify one of the following values.
     */
    const MB_ICONEXCLAMATION = 0x00000030; // An exclamation-point icon appears in the message box.
    const MB_ICONWARNING = 0x00000030; // An exclamation-point icon appears in the message box.
    const MB_ICONINFORMATION = 0x00000040; // An icon consisting of a lowercase letter i in a circle appears in the message box.
    const MB_ICONASTERISK = 0x00000040; // An icon consisting of a lowercase letter i in a circle appears in the message box.
    const MB_ICONQUESTION = 0x00000020; // A question-mark icon appears in the message box.
    const MB_ICONSTOP = 0x00000010; // A stop-sign icon appears in the message box.
    const MB_ICONERROR = 0x00000010; // A stop-sign icon appears in the message box.
    const MB_ICONHAND = 0x00000010; // A stop-sign icon appears in the message box.

    /**
     * uType - Type: UINT
     * To indicate the default button, specify one of the following values.
     */
    const MB_DEFBUTTON1 = 0x00000000; // The first button is the default button.
    const MB_DEFBUTTON2 = 0x00000100; // The second button is the default button.
    const MB_DEFBUTTON3 = 0x00000200; // The third button is the default button.
    const MB_DEFBUTTON4 = 0x00000300; // The fourth button is the default button.

    /**
     * uType - Type: UINT
     * To indicate the modality of the dialog box, specify one of the following values.
     */
    const MB_APPLMODAL = 0x00000000;
    const MB_SYSTEMMODAL = 0x00001000;
    const MB_TASKMODAL = 0x00002000;

    /**
     * uType - Type: UINT
     * To specify other options, use one or more of the following values.
     */
    const MB_DEFAULT_DESKTOP_ONLY = 0x00020000; // Same as desktop of the interactive window station. For more information, see Window Stations.
    const MB_RIGHT = 0x00080000; // The text is right-justified.
    const MB_RTLREADING = 0x00100000; // Displays message and caption text using right-to-left reading order on Hebrew and Arabic systems.
    const MB_SETFOREGROUND = 0x00010000; // The message box becomes the foreground window. Internally, the system calls the SetForegroundWindow function for the message box.
    const MB_TOPMOST = 0x00040000; // The message box is created with the WS_EX_TOPMOST window style.
    const MB_SERVICE_NOTIFICATION = 0x00200000; // The caller is a service notifying the user of an event.

    /**
     * Return code/value.
     */
    const IDOK = 1; // The OK button was selected.
    const IDCANCEL = 2; // The Cancel button was selected.
    const IDABORT = 3; // The Abort button was selected.
    const IDRETRY = 4; // The Retry button was selected.
    const IDIGNORE = 5; // The Ignore button was selected.
    const IDYES = 6; // The Yes button was selected.
    const IDNO = 7; // The No button was selected.
    const IDCLOSE = 8;
    const IDHELP = 9;
    const IDTRYAGAIN = 10; // The Try Again button was selected.
    const IDCONTINUE = 11; // The Continue button was selected.

    /**
     * @var string
     */
    private string $lib = 'User32.dll';

    /**
     * @var string
     */
    private string $declaration = 'int MessageBoxA(int hWnd, char * lpText, char * lpCaption, int uType);';

    /**
     * WindowsMsgBox constructor.
     * @param  int|null  $hWnd
     * @param  string  $lpText
     * @param  string|null  $lpCaption
     * @param  int  $uType
     */
    public function __construct(
        private ?int $hWnd,
        private string $lpText,
        private ?string $lpCaption,
        private int $uType
    ) {
    }

    /**
     * @param  int|null  $hWnd
     * @param  string  $lpText
     * @param  string|null  $lpCaption
     * @param  int  $uType
     * @return MessageBoxA
     */
    public static function init(
        ?int $hWnd,
        string $lpText,
        ?string $lpCaption,
        int $uType
    ): MessageBoxA {
        return new self($hWnd, $lpText, $lpCaption, $uType);
    }

    /**
     * @return int
     */
    public function call(): int
    {
        /** @var FFI $ffi */
        $ffi = FFI::cdef($this->declaration, $this->lib);

        /** @psalm-suppress UndefinedMethod * */
        return (int) $ffi->MessageBoxA(
            $this->hWnd,
            $this->lpText,
            $this->lpCaption,
            $this->uType);
    }
}
