@echo off
 
setlocal

set /p go_through="Go though with it?"
set theme=%CD%
set time_stamp=%date:~0,2%_%date:~3,2%_%date:~6,2%__%time:~0,2%_%time:~3,2%_%time:~6,2%
set version=1.1
set theme_name=Recyclabook
set theme_uri=recyclabook.co.uk
set copy_path="\Users\Aleksandar/Desktop/recyclabook_%time_stamp%"
set ftp_host=recyclabook.co.uk
set ftp_upload_directory=public_html/wp-content/themes/
set ftp_username=recyclab
set ftp_password=thinkbigger1
set zip_directory=%copy_path%
set zip_path=%copy_path%

IF %go_through%==y (

	echo.Gone through with it
	call batch/set_style_css_to_new_version
	call batch/create_a_filtered_copy_of_folder
	:: call batch/zip_a_directory
	:: call batch/create_ftp_connection_and_upload_files_to_server
	echo. Going back to original path
	cd %theme%
)

endlocal
@echo on