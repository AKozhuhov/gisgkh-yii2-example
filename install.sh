#!/usr/bin/env bash

SCRIPT=$(readlink -f "$0")
ROOT=$(dirname "$SCRIPT")

cd ${ROOT}

npm install
npm run install-web