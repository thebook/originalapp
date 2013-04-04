cd "%zip_directory%"
echo.Zipping Folder %zip_directory% into %zip_path%.zip
set path="C:\Program Files\WinRAR\";%path%
winrar a -afzip -r %zip_path%