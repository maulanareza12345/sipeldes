@echo off
cd /d "%~dp0"
if exist "C:\xampp\xampp-control.exe" (
    start "XAMPP" "C:\xampp\xampp-control.exe"
) else if exist "C:\xampp1\xampp-control.exe" (
    start "XAMPP" "C:\xampp1\xampp-control.exe"
) else (
    echo XAMPP tidak ditemukan. Pastikan XAMPP terinstall.
    pause
)
