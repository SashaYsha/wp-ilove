#!/bin/bash
set -eu pipefail
PROJECT=ilove
wp config create --dbname=$PROJECT --dbuser=$PROJECT --dbpass=$PROJECT || true
wp core download --locale=ru_RU || true
wp core install --url=wp-ilove.test --title="WP ilove" --admin_user=dev --admin_password=dev00998877 --admin_email=dev@ilove.test
wp core version