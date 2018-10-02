#!/bin/bash
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color
#
# Download latest WordPress, unzip, and move files to current directory.
wget https://wordpress.org/latest.tar.gz
tar xzvf latest.tar.gz
cd wordpress
mv * ..
cd ..
rmdir wordpress
rm latest.tar.gz

# Get sample composer.json from repo, update name, and install dependencies.
curl https://raw.githubusercontent.com/brightoak/wordpress-starter/master/sample.composer.json --output composer.json
printf "${GREEN}Enter the composer project name.\n"
printf "What you enter will replace PROJECT in 'brightoak/PROJECT'.\n"
printf "This will also be used as the theme name.\n"
printf "${YELLOW}Hit Enter to continue after entering name.\n${NC}"
read projectName
sed -i.bak "s/PROJECTNAME/$projectName/" composer.json
composer install
# Use require for these instead of putting them in the composer.json so the latest version can be pulled.
composer require wpackagist-plugin/google-apps-login wpackagist-plugin/disable-emojis wpackagist-plugin/wordpress-seo

# Install Sage
cd wp-content/themes/
composer create-project roots/sage $projectName
cd $projectName
yarn
yarn build

# Get database info and update wp-config-sample.php.
printf "${YELLOW}Enter database host IP:${NC}\n"
read dbHost
printf "${YELLOW}Enter database name:${NC}\n"
read dbName
printf "${YELLOW}Enter database username:${NC}\n"
read dbUser
printf "${YELLOW}Enter database password:${NC}\n"
read dbPassword

#Change dir back to project root.
cd ../../..
sed -i.bak "s/database_name_here/$dbName/" wp-config-sample.php
sed -i.bak "s/username_here/$dbUser/" wp-config-sample.php
sed -i.bak "s/password_here/$dbPassword/" wp-config-sample.php
sed -i.bak "s/localhost/$dbHost/" wp-config-sample.php

# Get WordPress salts and update config
# CREDIT: https://www.jbmurphy.com/2015/10/29/bash-script-to-change-the-security-keys-and-salts-in-a-wp-config-php-file/
SALTS=$(curl -s https://api.wordpress.org/secret-key/1.1/salt/)
while read -r SALT; do
SEARCH="define('$(echo "$SALT" | cut -d "'" -f 2)"
REPLACE=$(echo "$SALT" | cut -d "'" -f 4)
echo "... $SEARCH ... $SEARCH ..."
sed -i.bak "/^$SEARCH/s/put your unique phrase here/$(echo $REPLACE | sed -e 's/\\/\\\\/g' -e 's/\//\\\//g' -e 's/&/\\\&/g')/" wp-config-sample.php
done <<< "$SALTS"

mv wp-config-sample.php wp-config.php

# Setup site data and create DB tables
# Get database info and update wp-config-sample.php.
printf "${YELLOW}Enter local development URL:${NC}\n"
read devUrl
printf "${YELLOW}Enter site title:${NC}\n"
read devTitle
printf "${YELLOW}Enter admin username:${NC}\n"
read devAdminName
printf "${YELLOW}Enter admin email:${NC}\n"
read devAdminEmail

wp db reset
wp core install --url="$devUrl" --title="$devTitle" --admin_user="$devAdminName" --admin_email="$devAdminEmail"
wp plugin activate --all

#wp plugin activate --all

rm *.bak
printf "${YELLOW}You must manually activate the Sage theme from within WordPress.${NC}\n"
printf "${YELLOW}Your password is in the output above.${NC}\n"
printf "${GREEN}Setup Complete!\n"
printf "You can now visit the local development site at $devUrl ${NC}\n"