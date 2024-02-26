#!/bin/bash
_BACK="$(pwd)"; _PATH="${BASH_SOURCE[0]}"; _APP=$(readlink "$_PATH"); _PATH=$(dirname "$_PATH"); cd "$_PATH"; _APP=$(dirname "$_APP"); _APP=$(realpath "$_APP"); cd "$_BACK"

php -f "$_APP/app.php" $*
#echo ""0

