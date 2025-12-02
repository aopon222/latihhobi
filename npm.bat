@echo off
setlocal enabledelayedexpansion
set "NODE_PATH=C:\laragon\bin\nodejs\node-v22"
set "PATH=%NODE_PATH%;%PATH%"
set "NODE_SKIP_PLATFORM_CHECK=1"
C:\laragon\bin\nodejs\node-v22\node.exe C:\laragon\bin\nodejs\node-v22\node_modules\npm\bin\npm-cli.js %*
