#!/bin/sh

BIND_ADDR=${BIND_ADDR:="0.0.0.0"}
BIND_PORT=${BIND_PORT:="8080"}

php -S $BIND_ADDR:$BIND_PORT workers/"$1".php
