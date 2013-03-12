@echo off
 
setlocal
 
set working_theme=%CD%
 
:: Copy
echo.Copying %CD%
robocopy %CD% ../theme /S /XF *.gitignore *.scss *.scssc *.sublime-project *.sublime-workspace /XD .git .sass-cache sass

cd \
cd C:\Users\Cikica.Stefan-PC/Desktop/recyclabook/
 
:: Zip
::echo.Zipping Theme
::set path="C:\Program Files\WinRAR\";%path%
 
::winrar a -afzip -r "../whitewhale"
 
cd %working_theme%
 
endlocal
 
@echo on