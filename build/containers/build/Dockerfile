FROM debian:stretch

# Some system upgrades
RUN apt-get update && \
    apt-get dist-upgrade --yes

RUN apt-get install --yes \
    # "Basic" tools 
    curl \
    python python-pip \
    # Task runner runtime
    php && \
    # Linting Tools
    pip install \
        yamllint

# Install the task runer
RUN curl -O https://robo.li/robo.phar && \
    chmod +x ./robo.phar && \
    mv ./robo.phar /usr/local/bin/robo