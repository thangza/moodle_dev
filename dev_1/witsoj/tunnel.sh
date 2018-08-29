#!/bin/bash

#SSH Tunnel into "target_host" via the proxy "proxy_host"

target_host="moodle-dev1.ms.wits.ac.za"
proxy_host="lamp.ms.wits.ac.za"
username_proxy=$1
local_port=3333
target_port=22

echo "Connecting to ${proxy_host} on local port: ${local_port}"
echo "..."
ssh -L ${local_port}:${target_host}:${target_port} ${username_proxy}@${proxy_host}
echo "Connection with ${proxy_host} closed."