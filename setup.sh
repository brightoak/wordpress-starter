#!/bin/bash
wget https://wordpress.org/latest.tar.gz
tar xzvf latest.tar.gz
cd wordpress
mv * ..
cd ..
rmdir wordpress
rm latest.tar.gz
read year