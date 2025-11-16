@echo off
setlocal enabledelayedexpansion
set "NODE_PATH=C:\laragon\bin\nodejs\node-v22"
set "PATH=%NODE_PATH%;%PATH%"

REM Jalankan npm dengan arguments yang diberikan
%NODE_PATH%\npm.cmd %*
