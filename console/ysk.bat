@echo off

rem ---------------------------------------------------------------
rem  ysk.bat — Yii2 Starter Kit Docker helper for Windows (CMD)
rem  Delegates to ysk.ps1 (PowerShell).
rem
rem  Usage:  console\ysk <command> [arguments]
rem ---------------------------------------------------------------

powershell.exe -NoLogo -NoProfile -ExecutionPolicy Bypass -File "%~dp0ysk.ps1" %*
