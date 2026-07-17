@echo off
cd /d "%~dp0"
set PHP_EXE=C:\laragon\bin\php\php-8.3.26-Win32-vs16-x64\php.exe
set ARTISAN=artisan
start "Laravel" cmd /k "%PHP_EXE% %ARTISAN% serve --host=127.0.0.1 --port=8000"
echo Menjalankan Laravel...
ping -n 3 127.0.0.1 > nul
exit /b 0
