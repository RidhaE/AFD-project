
# Installing dependencies
apt-get update && apt-get install -y \
    build-essential \
    mysql-client \
    openssl \
    locales \
    zip \
    zlib1g-dev \
    libicu-dev \
    libzip-dev \
    chromium

curl -sS -o /tmp/icu.tgz -L http://download.icu-project.org/files/icu4c/62.1/icu4c-62_1-src.tgz \
  && tar -zxf /tmp/icu.tgz -C /tmp \
  && cd /tmp/icu/source \
  && ./configure --prefix=/usr/local \
  && make \
  && make install

# Clear cache
apt-get clean && rm -rf /var/lib/apt/lists/*
 
 

ENV PANTHER_NO_SANDBOX 1

 mkdir -p \
		var/sessions \
	&& chown -R www-data var
