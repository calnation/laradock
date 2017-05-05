#!/bin/bash
cd $(dirname "$(readlink -f $0)")
docker build -t wikitolearn/parsoid:0.4 .

