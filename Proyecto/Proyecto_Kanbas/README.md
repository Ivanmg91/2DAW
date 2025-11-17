COMO INICIAR PHPMYADMIN

ps aux | grep mysqld
sudo systemctl stop mysql
sudo kill -9 <PID_DEL_PROCESO>
sudo /opt/lampp/lampp startmysql / startapache
sudo /opt/lampp/lampp status
http://localhost/phpmyadmin
sudo /opt/lampp/lampp stop


PARA ACCEDER A MYSQL: mysql -u root -h 127.0.0.1

INSTALAR ESTO EN EL SISTEMA: sudo apt-get install php-mysql