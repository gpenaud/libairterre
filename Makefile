ONESHELL:
SHELL := /bin/bash

## HELP
PROJECT           = libairterre
## Colors
COLOR_RESET       = $(shell tput sgr0)
COLOR_ERROR       = $(shell tput setaf 1)
COLOR_COMMENT     = $(shell tput setaf 3)
COLOR_TITLE_BLOCK = $(shell tput setab 4)

## Display this help text
help:
	@printf "\n"
	@printf "${COLOR_TITLE_BLOCK}${PROJECT} Makefile${COLOR_RESET}\n"
	@printf "\n"
	@printf "${COLOR_COMMENT}Usage:${COLOR_RESET}\n"
	@printf " make build\n\n"
	@printf "${COLOR_COMMENT}Available targets:${COLOR_RESET}\n"
	@awk '/^[a-zA-Z\-\_0-9\@]+:/ { \
				helpLine = match(lastLine, /^## (.*)/); \
				helpCommand = substr($$1, 0, index($$1, ":")); \
				helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
				printf " ${COLOR_INFO}%-20s${COLOR_RESET} %s\n", helpCommand, helpMessage; \
		} \
		{ lastLine = $$0 }' $(MAKEFILE_LIST)
	@printf "\n"

up:
	docker-compose up --build --detach
	docker-compose logs --follow libairterre

down:
	docker-compose down --volumes

backup-site:
	bash scripts/backup_site_libairterre.sh

install-mkcert:
	sudo apt install --yes libnss3-tools
	sudo wget -O /usr/local/bin/mkcert "https://github.com/FiloSottile/mkcert/releases/download/v1.4.3/mkcert-v1.4.3-linux-amd64" && chmod +x /usr/local/bin/mkcert
	mkcert -install

generate-certificates:
	mkcert -cert-file httpd/certificates/cert.pem -key-file httpd/certificates/key.pem libairterre.localhost

upload-agenda-css:
	rm data/www/plugins-dist/organiseur/lib/fullcalendar/fullcalendar.min.css;
	yui-compressor data/www/plugins-dist/organiseur/lib/fullcalendar/fullcalendar.css > data/www/plugins-dist/organiseur/lib/fullcalendar/fullcalendar.min.css
	lftp USER:PASSWORD@ftp.cluster027.hosting.ovh.net -e "put -O www/plugins-dist/organiseur/lib/fullcalendar/ data/www/plugins-dist/organiseur/lib/fullcalendar/fullcalendar.css; bye";
	lftp USER:PASSWORD@ftp.cluster027.hosting.ovh.net -e "put -O www/plugins-dist/organiseur/lib/fullcalendar/ data/www/plugins-dist/organiseur/lib/fullcalendar/fullcalendar.min.css; bye";
	lftp USER:PASSWORD@ftp.cluster027.hosting.ovh.net -e "put -O www/plugins/html5up_editorial/css/ data/www/plugins/html5up_editorial/css/theme.scss; bye";
	lftp USER:PASSWORD@ftp.cluster027.hosting.ovh.net -e "put -O www/plugins/html5up_editorial/css/layout/ data/www/plugins/html5up_editorial/css/layout/_banner.scss; bye";

upload-agenda-squelettes:
	lftp USER:PASSWORD@ftp.cluster027.hosting.ovh.net -e "put -O www/plugins/html5up_editorial/content/ data/www/plugins/html5up_editorial/content/article.html; bye";
	lftp USER:PASSWORD@ftp.cluster027.hosting.ovh.net -e "put -O www/plugins/html5up_editorial/content/ data/www/plugins/html5up_editorial/content/rubrique.html; bye";
	lftp USER:PASSWORD@ftp.cluster027.hosting.ovh.net -e "put -O www/plugins/html5up_editorial/inclure/ data/www/plugins/html5up_editorial/inclure/article-hero.html; bye";
