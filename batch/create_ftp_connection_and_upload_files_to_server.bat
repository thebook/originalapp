echo.Establishing connection with %ftp_host% with username %ftp_username% and uploading %copy_path%
ncftpput -u %ftp_username% -p %ftp_password% -R -z -t 600 %ftp_host% %ftp_upload_directory% "%copy_path%"
echo.File transfer complete