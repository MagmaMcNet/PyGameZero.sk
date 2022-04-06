@echo off
setlocal enabledelayedexpansion
rem Set the message to issue as second line
set "msg=*         Starting         *"
rem Calculate the length of the string
set Length=0
for /l %%A in (1,1,1000) do if "%msg%"=="!msg:~0,%%A!" (
    set /a Length=%%A
    goto :doit
)
:doit
rem Create a string of asterisks of same length
set header=
for /l %%i in (1,1,%Length%) do set "header=!header!*
color 02
title Web Server Server
:g
cls
echo.
powershell write-host -fore Cyan ______________________________Starting Web Server______________________________
powershell write-host -fore Cyan *******************************************************************************
timeout /t 1 >nul
echo.
php -S localhost:8000 -t .
echo.
echo.
timeout /t 1 >nul
powershell write-host -fore Cyan *******************************************************************************
powershell write-host -fore Red ______________________________Web Server Stopped______________________________
timeout /t 5
goto g
pause >nul