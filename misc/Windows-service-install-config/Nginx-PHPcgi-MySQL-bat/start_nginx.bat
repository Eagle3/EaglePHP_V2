@echo off 
echo Starting nginx...
RunHiddenConsole D:/phpenv/nginx/nginx.exe -p D:/phpenv/nginx
echo Starting PHP FastCGI...
RunHiddenConsole D:/phpenv/php5.6.33-nts/php-cgi.exe -b 127.0.0.1:9001 -c D:/phpenv/php5.6.33-nts/php.ini