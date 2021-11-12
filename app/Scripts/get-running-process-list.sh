#!/bin/bash
# finds names of all running processes

ps -e | awk '{print $4}' | tail -n +2