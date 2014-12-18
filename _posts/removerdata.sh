#!/bin/bash
for f in *.markdown ; do awk '!/date: /' "$f"  > temp && mv temp "$f" ; done