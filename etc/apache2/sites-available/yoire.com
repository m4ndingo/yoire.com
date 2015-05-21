<VirtualHost *:80>
	ServerAdmin mipropaganda@gmail.com
	ServerName yoire.com
	ServerSignature Off

	DocumentRoot /var/www/yoire.com
	<Directory />
		Options FollowSymLinks
		AllowOverride None
	</Directory>
	<Directory /var/www/yoire.com/>
		Options Indexes FollowSymLinks MultiViews
		AllowOverride None
		Order allow,deny
		allow from all
	</Directory>
	<Directory /var/www/yoire.com/tron/>
		AllowOverride None
		DirectoryIndex index.html index.htm index.php controller.php
		php_flag log_errors on
		php_flag display_errors on
		php_value error_reporting 3
		php_value memory_limit 128M
		php_value max_execution_time 30
		php_admin_value disable_functions "system,exec,passthru,shell_exec,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source,ini_set,phpinfo,session_start,pcntl_exec,pcntl_fork"
	</Directory>
	<Directory /var/www/yoire.com/img/v/>
     		<FilesMatch "(?i)\.(php|php3?|phtml)$">
            		Order Deny,Allow
            		Deny from All
		</FilesMatch>
	 </Directory>
        <Directory /var/www/yoire.com/img/>
                <FilesMatch "(?i)\.(php|php3?|phtml)$">
                        Order Deny,Allow
                        Deny from All
                </FilesMatch>
         </Directory>

	RewriteEngine On
	RewriteCond %{QUERY_STRING} mo=Chat
	RewriteRule (.*) $1 [E=dontlog:1]
	SetEnvIf Request_URI "^/img" dontlog
	
	ErrorLog ${APACHE_LOG_DIR}/yoire.com-error.log 

	# Possible values include: debug, info, notice, warn, error, crit,
	# alert, emerg.
	LogLevel warn

	CustomLog ${APACHE_LOG_DIR}/yoire.com-access.log combined env=!dontlog
</VirtualHost>
