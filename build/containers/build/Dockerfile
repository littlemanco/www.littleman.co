FROM debian:buster

# Some system upgrades
RUN apt-get update && \
    apt-get dist-upgrade --yes

# Installation Dependencies
RUN apt-get install --yes \
    curl \
    python python-pip \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common \
    lsb-release

# img installation
RUN export IMG_SHA256="f5d686465a7463c296e94634bd9597af58544ead924567c9128a4ee352591bf1" \ 
    && curl -fSL "https://github.com/genuinetools/img/releases/download/v0.5.6/img-linux-amd64" -o "/usr/local/bin/img" \
    && echo "${IMG_SHA256}  /usr/local/bin/img" | sha256sum -c - \
    && chmod a+x "/usr/local/bin/img"

# Tool installation
RUN apt-get update && \
    apt-get install --yes \
    # Version control \
    git \
    # Static site runtime \
    ruby \
    # Static site generator \
    hugo \
    # Task runner runtime
    php && \
    # Linting Tools
    pip install \
        yamllint

# Compilation
RUN gem install \
        asciidoctor:1.5.8 \
        asciidoctor-bibtex \
        rouge

COPY bin/asciidoctor /usr/local/bin/asciidoctor

# Install the task runer
RUN curl -O https://robo.li/robo.phar && \
    chmod +x ./robo.phar && \
    mv ./robo.phar /usr/local/bin/robo