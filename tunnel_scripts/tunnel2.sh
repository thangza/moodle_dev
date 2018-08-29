#!/bin/bash

# SSH Tunnel into "target_host" via "proxy_host"
# Usage: ./tunnel.sh s1396469
# connection to dev2

target_host="moodle-dev2.ms.wits.ac.za"
proxy_host="lamp.ms.wits.ac.za"
username_lamp=$1
local_port=3333
target=22

echo "Connecting to ${proxy_host} on local: ${local_port}"
echo "..."
ssh -L ${local_port}:${targer_host}:${target_port} ${username_lamp}@${proxy_host}
echo "Connection with ${proxy_host} closed."
