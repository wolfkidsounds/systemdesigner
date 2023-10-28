@echo off
setlocal enabledelayedexpansion

:check_changes
call git status | findstr /C:"composer.lock" /C:"composer.json" /C:"symfony.lock" /C:"package-lock.json" /C:"package.json" >nul

if %errorlevel%==0 (
    set old_color=%color%
    color 0C echo Changes were found in Composer, Symfony, or NPM files. Please commit these changes before proceeding.
    color %old_color%
    pause
    exit /b
) else (
    echo There are no current changes in Composer, Symfony, or NPM files.
)

echo Current Changes
call git status

echo Stashing current changes
call git stash save "Stashing current changes"

echo Pulling from GitHub repository
call git pull

echo Install Composer Dependencies & Zpdating
call composer install
call composer update

echo Install Node Dependencies & Updating
call npm install
call npm update

echo Commit Updates to GitHub
call git add .
call git commit -m "Update dependencies"

echo Reload Stashed Changes
call git stash pop
call git status