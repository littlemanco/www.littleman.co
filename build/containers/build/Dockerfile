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
    tar \
    gnupg-agent \
    software-properties-common \
    lsb-release

# img (container builder) installation
RUN export IMG_SHA256="f5d686465a7463c296e94634bd9597af58544ead924567c9128a4ee352591bf1" \ 
    && curl -fSL "https://github.com/genuinetools/img/releases/download/v0.5.6/img-linux-amd64" -o "/usr/local/bin/img" \
    && echo "${IMG_SHA256}  /usr/local/bin/img" | sha256sum -c - \
    && chmod a+x "/usr/local/bin/img"

# Google Cloud APT repository
RUN export CLOUD_SDK_REPO="cloud-sdk-$(lsb_release -c -s)" \
     && echo "deb http://packages.cloud.google.com/apt $CLOUD_SDK_REPO main" > /etc/apt/sources.list.d/google-cloud-sdk.list \
     && curl https://packages.cloud.google.com/apt/doc/apt-key.gpg | apt-key add -

# Helm installation
RUN cd $(mktemp -d) \
    && curl -O https://storage.googleapis.com/kubernetes-helm/helm-v2.13.1-linux-amd64.tar.gz \
    && tar --extract --file helm-v2.13.1-linux-amd64.tar.gz \
    && mv linux-amd64/helm  /usr/local/bin/

# Other tools
RUN apt-get update && \
    apt-get install --yes \
    # Version control \
    git \
    # Static site runtime \
    ruby \
    # Cloud integration \
    google-cloud-sdk \
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