#!/bin/bash
# Copyright (C) 2013, 2014 Triassic. All rights reserved.
# 
# Delete database user, database schema and data from database
# for MVCCC web application.

LOGFILE=/tmp/uninstall_`date +%H%M%S`.log
defaultHost=localhost
defaultPort=3306
defaultUsername=root
defaultMysqlPath=/Applications/XAMPP/xamppfiles/bin/

log(){
    message="$@"
    echo $message
    echo $message >> $LOGFILE
}

log "Uninstalling MVCCC database schema..."

# Read MySQL server host
echo -n "MySQL server host [$defaultHost]:"
read host
if [ "$host" == "" ]
then
    host=$defaultHost
fi

# Read MySQL server port
echo 
echo -n "MySQL server port [$defaultPort]:"
read port
if [ "$port" == "" ]
then
    port=$defaultPort
fi

# Read MySQL username
echo
echo -n "MySQL username [$defaultUsername]:"
read username
if [ "$username" == "" ]
then
    username=$defaultUsername
fi

# Read MySQL password
echo
echo -n "MySQl password:"
stty -echo
read password
stty echo
echo

# Read MySQL path
echo
echo -n "mysql path [$defaultMysqlPath]:"
read mysqlPath
if [ "$mysqlPath" == "" ]
then
    mysqlPath=$defaultMysqlPath
fi

echo
log "Summary:"
log "MySQL server host: $host."
log "MySQL server port: $port."
log "MySQL username   : $username."
log "MySQL path       : $mysqlPath."

# ${mysqlPath}mysqladmin --user=$username --password=$password --host=$host --port=$port drop $database
${mysqlPath}mysql --user=$username --password=$password --host=$host --port=$port $database < ../sql/mvccc_uninstall.sql >> $LOGFILE
