#!/bin/bash

ps -e | awk '{print $4}' | tail -n +2