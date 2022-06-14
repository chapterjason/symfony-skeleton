#!/usr/bin/env bash

set -euo pipefail

BIN_DIRECTORY="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
PROJECT_DIRECTORY="$( cd "${BIN_DIRECTORY}/.." && pwd )"

pushd "${PROJECT_DIRECTORY}" > /dev/null

./bin/fix-cs
./bin/psalm
./bin/phpmd

symfony console lint:container
symfony console lint:yaml config/ src/

./bin/phpunit
