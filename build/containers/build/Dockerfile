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

# Docker installation
RUN curl -fsSL https://download.docker.com/linux/ubuntu/gpg | apt-key add - && \
    add-apt-repository \
        "deb [arch=amd64] https://download.docker.com/linux/debian \
        $(lsb_release -cs) \
        stable"

# Tool installation
RUN apt-get update && \
    apt-get install --yes \
    # Artifact generation 
    docker-ce-cli \
    # Version control \
    git \
    # Task runner runtime
    php && \
    # Linting Tools
    pip install \
        yamllint

# Install the task runer
RUN curl -O https://robo.li/robo.phar && \
    chmod +x ./robo.phar && \
    mv ./robo.phar /usr/local/bin/robo