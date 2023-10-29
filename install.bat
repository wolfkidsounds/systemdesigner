@echo off
setlocal enabledelayedexpansion

:check_changes
call git status | findstr /C:"composer.lock" /C:"composer.json" /C:"symfony.lock" /C:"package-lock.json" /C:"package.json" >nul

if %errorlevel%==0 (
    echo ======================================================
    echo Changes were found in Composer, Symfony, or NPM files.
    echo Please commit these changes before proceeding.
    echo ======================================================
    pause
    exit /b
) else (
    echo ======================================================
    echo There are no current changes in Composer, Symfony, or NPM files.
    echo Continue the script.
    echo ======================================================
)

echo ======================================================
echo Pulling from GitHub repository
echo ======================================================
call git pull

echo ======================================================
echo Stashing current changes
echo ======================================================
call git stash save "Stashing current changes"

echo ======================================================
echo Install Composer Dependencies
echo ======================================================
call composer install

echo ======================================================
echo Install Node Dependencies
echo ======================================================
call npm install

echo ======================================================
echo Install Updates
echo ======================================================
call composer update
call npm update

echo ======================================================
echo Save & Upload Changes
echo ======================================================
call git add .
call git commit -m "Update dependencies"
call git push

echo ======================================================
echo Reload Stashed Changes
echo ======================================================
call git stash pop